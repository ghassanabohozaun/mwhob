<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\MawhobEnrollCourse;
use App\Models\MawhobEnrollProgram;
use App\Models\MawhobEnrollSummerCamp;
use App\Models\Mawhoob_Notification;
use App\Models\Program;
use App\Models\Revenue;
use App\Models\SummerCamp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;


class PaymentController extends Controller
{
    private $apiContext;
    private $secret;
    private $clientId;

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    /// construct
    public function __construct()
    {
        if (config('paypal.settings.mode') == 'live') {
            $this->clientId = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        } else {
            $this->clientId = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->clientId, $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Pay With Paypal
    public function payWithPaypal(Request $request)
    {
        $item_type = $request->input('item_type');
        $item_id = $request->input('item_id');
        $mawhob_id = $request->input('mawhob_id');
        $item_price = $request->input('item_price');
        $item_name = $request->input('item_name');

        // set payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        // set item
        $item = new Item();
        $item->setName($item_name)
            ->setCurrency('ILS')
            ->setQuantity(1)
            ->setDescription("this is item description")
            ->setPrice($item_price);
        // item List
        $itemList = new ItemList();
        $itemList->setItems([$item]);

        // amount
        $amount = new Amount();
        $amount->setCurrency("ILS")
            ->setTotal($item_price);

        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment somethings from Mwhoob");

        // urls
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.status', ['item_type' => $item_type, 'item_id' => $item_id, 'mawhob_id' => $mawhob_id]))
            ->setCancelUrl(route('paypal.cancel', ['item_type' => $item_type]));

        // payment
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->apiContext);
        } catch (\Paypal\Exception\PayPalConfigurationException $ex) {
            die($ex);
        }

        //  approval Url
        $approvalUrl = $payment->getApprovalLink();
        return redirect($approvalUrl);


    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    /// pay status
    public function paypalStatus(Request $request)
    {
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            die('Payment Failed');
        }

        $paymentId = $request->get('paymentId');
        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved') {
            if ($request->item_type == 'program') {
                return $this->programApproved($request->item_id, $request->mawhob_id,
                    $request->input('paymentId'), $request->input('token'), $request->input('PayerID'));
            } elseif ($request->item_type == 'course') {
                return $this->courseApproved($request->item_id, $request->mawhob_id,
                    $request->input('paymentId'), $request->input('token'), $request->input('PayerID'));
            } elseif ($request->item_type == 'summerCamp') {
                return $this->summerCampApproved($request->item_id, $request->mawhob_id,
                    $request->input('paymentId'), $request->input('token'), $request->input('PayerID'));
            }
        }
        echo 'Payment Failed Again';
        die($result);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////
    /// pay cancel
    public function paypalCancel(Request $request)
    {
        if ($request->item_type == 'program') {
            return redirect()->route('programs');
        } elseif ($request->item_type == 'course') {
            return redirect()->route('courses');
        } elseif ($request->item_type == 'summerCamp') {
            return redirect()->route('summer.camps');
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////
    /// Program Approved
    protected function programApproved($program_id, $mawhob_id, $paymentId, $token, $PayerID)
    {
        ////////////////////////////////////////////////////////////////////
        ///// enroll program
        $mawhobEnrollProgram = MawhobEnrollProgram::create([
            'program_id' => $program_id,
            'mawhob_id' => $mawhob_id,
            'enrolled_date' => Carbon::now()->format('Y-m-d'),
        ]);
        ///////////////////////////////////////////////////////
        /// add  Revenue
        $programPrice = Program::find($program_id)->price;
        $programDiscount = Program::find($program_id)->discount;
        if ($programDiscount == '' || $programDiscount == 0) {
            $value = $programPrice;
        } else {
            $value = $programDiscount;
        }

        Revenue::create([
            'mawhob_id' => $mawhob_id,
            'date' => Carbon::now()->format('Y-m-d'),
            'value' => $value,
            'revenue_for' => $program_id,
            'details' => 'enroll_program',
            'payment_method'=>'PayPal',
            'payer_id' => $PayerID,
            'payment_id' => $paymentId,
            'token' => $token,
        ]);

        ////////////////////////////////////////////////////
        ///   enrolled program admin notification
        Mawhoob_Notification::create([
            'title_ar' => 'تنبيه التسجيل في برنامج',
            'title_en' => 'Enrolled In Program Notification',

            'details_ar' => ' قام الموهوب   ' . $mawhobEnrollProgram->mawhob->mawhob_full_name
                . ' بالتسجيل في البرنامج التالي   ' . $mawhobEnrollProgram->program->name_ar,

            'details_en' => ' The Mawhoob   ' . $mawhobEnrollProgram->mawhob->mawhob_full_name_en
                . ' Enrolled In This Program   ' . $mawhobEnrollProgram->program->name_en,
            'notify_status' => 'send',
            'notify_class' => 'unread',
            'notify_for' => 'admin',
        ]);

        ////////////////////////////////////////////////////
        ///   enrolled program admin notification
        Mawhoob_Notification::create([
            'title_ar' => 'تنبيه التسجيل في برنامج',
            'title_en' => 'Enrolled In Program Notification',
            'details_ar' => ' قمت  بالتسجيل في البرنامج التالي ' . $mawhobEnrollProgram->program->name_ar,
            'details_en' => ' You   Enrolled In This Program  ' . $mawhobEnrollProgram->program->name_en,
            'notify_status' => 'send',
            'notify_class' => 'unread',
            'notify_for' => 'mawhob',
            'student_id' => student()->id(),
        ]);

        return redirect()->route('student.program.checkout', $program_id)
            ->with(['success' => trans(trans('site.program_has_been_purchased'))]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////
    /// Course Approved
    protected function courseApproved($course_id, $mawhob_id, $paymentId, $token, $PayerID)
    {
        ////////////////////////////////////////////////////////////////////
        ///// enroll Course
        $mawhobEnrollCourse = MawhobEnrollCourse::create([
            'course_id' => $course_id,
            'mawhob_id' => $mawhob_id,
            'enrolled_date' => Carbon::now()->format('Y-m-d'),
        ]);


        ////////////////////////////////////////////////////////////////////
        ///// Course Revenue
        $coureCost = Course::find($course_id)->cost;
        $coureDiscount = Course::find($course_id)->discount;
        if ($coureDiscount == '' || $coureDiscount == 0) {
            $value = $coureCost;
        } else {
            $value = $coureDiscount;
        }
        Revenue::create([
            'mawhob_id' => $mawhob_id,
            'date' => Carbon::now()->format('Y-m-d'),
            'value' => $value,
            'revenue_for' => $course_id,
            'details' => 'enroll_course',
            'payment_method'=>'PayPal',
            'payer_id' => $PayerID,
            'payment_id' => $paymentId,
            'token' => $token,
        ]);

        ////////////////////////////////////////////////////
        ///   enrolled course Admin notification
        Mawhoob_Notification::create([
            'title_ar' => 'تنبيه التسجيل في دورة',
            'title_en' => 'Enrolled In Course Notification',

            'details_ar' => ' قام الموهوب   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name
                . ' بالتسجيل في الدورة التالية  ' . $mawhobEnrollCourse->course->title_ar,

            'details_en' => ' The Mawhoob   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name_en
                . ' Enrolled In This Course   ' . $mawhobEnrollCourse->course->title_en,
            'notify_status' => 'send',
            'notify_class' => 'unread',
            'notify_for' => 'admin',
        ]);


        ////////////////////////////////////////////////////
        ///  student enrolled course  Teacher notification
        Mawhoob_Notification::create([
            'title_ar' => 'تنبيه التسجيل في دورة',
            'title_en' => 'Enrolled In Course Notification',

            'details_ar' => ' قام الموهوب   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name
                . ' بالتسجيل في دورتك التالية  ' . $mawhobEnrollCourse->course->title_ar,

            'details_en' => ' The Mawhoob   ' . $mawhobEnrollCourse->mawhob->mawhob_full_name_en
                . ' Enrolled In Your Course   ' . $mawhobEnrollCourse->course->title_en,
            'notify_status' => 'send',
            'notify_class' => 'unread',
            'notify_for' => 'teacher',
            'teacher_id' => $mawhobEnrollCourse->course->teacher_id,
        ]);

        ////////////////////////////////////////////////////
        ///  student enrolled course  student notification
        Mawhoob_Notification::create([
            'title_ar' => 'تنبيه التسجيل في دورة',
            'title_en' => 'Enrolled In Course Notification',

            'details_ar' => ' قمت بالتسجيل في الدورة التالية ' . $mawhobEnrollCourse->course->title_ar,

            'details_en' => ' You Enrolled In This Course  ' . $mawhobEnrollCourse->course->title_en,
            'notify_status' => 'send',
            'notify_class' => 'unread',
            'notify_for' => 'mawhob',
            'student_id' => $mawhob_id,
        ]);


        return redirect()->route('student.course.checkout', $course_id)
            ->with(['success' => trans(trans('site.course_has_been_purchased'))]);
    }


    /////////////////////////////////////////////////////////////////////////////////////////////
    /// Summer Camp Approved
    protected function summerCampApproved($sumner_camp_id, $mawhob_id, $paymentId, $token, $PayerID)
    {
        ////////////////////////////////////////////////////////////////////
        ///// enroll summer Camp
        $mawhobEnrollSummerCamp = MawhobEnrollSummerCamp::create([
            'summer_camp_id' => $sumner_camp_id,
            'mawhob_id' => $mawhob_id,
            'enrolled_date' => Carbon::now()->format('Y-m-d'),
        ]);

        ///////////////////////////////////////////////////////
        /// add  Revenue
        $summerCampPrice = SummerCamp::find($sumner_camp_id)->cost;
        $summerCampDiscount = SummerCamp::find($sumner_camp_id)->discount;

        if ($summerCampDiscount == '' || $summerCampDiscount == 0) {
            $value = $summerCampPrice;
        } else {
            $value = $summerCampDiscount;
        }
        Revenue::create([
            'mawhob_id' => $mawhob_id,
            'date' => \Illuminate\Support\Carbon::now()->format('Y-m-d'),
            'value' => $value,
            'revenue_for' => $sumner_camp_id,
            'details' => 'enroll_summer_camp',
            'payment_method'=>'PayPal',
            'payer_id' => $PayerID,
            'payment_id' => $paymentId,
            'token' => $token,
        ]);


        ////////////////////////////////////////////////////
        ///   enrolled summer camp Admin notification
        Mawhoob_Notification::create([
            'title_ar' => 'تنبيه التسجيل في مخيم صيفي',
            'title_en' => 'Enrolled In Summer Camp Notification',
            'details_ar' => ' قام الموهوب   ' . $mawhobEnrollSummerCamp->mawhob->mawhob_full_name
                . ' بالتسجيل في المخيم الصيفي التالية  ' . $mawhobEnrollSummerCamp->summerCamp->name_ar,
            'details_en' => ' The Mawhoob   ' . $mawhobEnrollSummerCamp->mawhob->mawhob_full_name_en
                . ' Enrolled In This summer Camp   ' . $mawhobEnrollSummerCamp->summerCamp->name_en,
            'notify_status' => 'send',
            'notify_class' => 'unread',
            'notify_for' => 'admin',
        ]);

        ////////////////////////////////////////////////////
        ///  student enrolled summer camp  student notification
        Mawhoob_Notification::create([
            'title_ar' => 'تنبيه التسجيل في مخيم صيفي',
            'title_en' => 'Enrolled In Summer Camp Notification',
            'details_ar' => ' قمت بالتسجيل في المخيم الصيفي التالية ' . $mawhobEnrollSummerCamp->summerCamp->name_ar,
            'details_en' => ' You Enrolled In This Summer Camp  ' . $mawhobEnrollSummerCamp->summerCamp->name_en,
            'notify_status' => 'send',
            'notify_class' => 'unread',
            'notify_for' => 'mawhob',
            'student_id' => $mawhob_id,
        ]);


        return redirect()->route('student.summer.camp.checkout', $sumner_camp_id)
            ->with(['success' => trans(trans('site.summer_camp_has_been_purchased'))]);
    }
}
