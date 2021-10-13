<?php

namespace App\Console\Commands;

use App\Models\Lecture;
use Illuminate\Console\Command;

class ActiveLecture extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'active:lecture';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Active Lecture Depend on Lecture From Column at Specific Time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $Lectures = Lecture::get();
        foreach ($Lectures as $lecture) {

            ////// convert time to 24:00 format as 12:10
            ////// lecture from
            $lectureFrom = strtotime($lecture->lecture_from);
            $lectureFromFormat = date('G:i', $lectureFrom);

            ////// lecture to
            $lectureTo = strtotime($lecture->lecture_to);
            $lectureToFormat = date('G:i', $lectureTo);

            ////// get current time with 24 format
            date_default_timezone_set('Asia/Gaza'); // CDT
            $current_time = date('H:i');

            ///// active lecture by check current time equal lecture from
            if ($current_time == $lectureFromFormat) {
                $lecture->status = 'on';
                $lecture->save();
            }

            ///// inactive lecture by check current time equal lecture to
            if ($current_time == $lectureToFormat) {
                $lecture->status = null;
                $lecture->save();
            }
        }
    }
}
