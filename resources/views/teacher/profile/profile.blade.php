@extends('layouts.teacher')
@section('title') @endsection
@section('content')
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Mobile Toggle-->
                    <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none"
                            id="kt_subheader_mobile_toggle">
                        <span></span>
                    </button>
                    <!--end::Mobile Toggle-->

                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">

                        </h5>
                        <!--end::Page Title-->
                        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>

                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">
                                    {{trans('teachers.profile')}}
                                </a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->

            </div>
        </div>
        <!--end::Subheader-->

        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class=" container ">
                <!--begin::Profile Overview-->
                <div class="d-flex flex-row">
                    <!--begin::Aside-->
                    <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                        <!--begin::Profile Card-->
                        <div class="card card-custom card-stretch">
                            <!--begin::Body-->
                            <div class="card-body pt-4">

                                <br/><br/>

                                <!--begin::User-->
                                <div class="d-flex align-items-center">
                                    <div
                                        class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                        @if(!$teacher->teacher_photo)
                                            @if($teacher->teacher_gender == trans('general.male'))
                                                <div class="symbol-label"
                                                     style="background-image:url({!! asset('adminBoard/images/male.jpeg') !!})"></div>
                                            @else
                                                <div class="symbol-label"
                                                     style="background-image:url({!! asset('adminBoard/images/female.jpeg') !!})"></div>
                                            @endif
                                        @else
                                            <div class="symbol-label"
                                                 style="background-image:url({!! \Illuminate\Support\Facades\Storage::url($teacher->teacher_photo) !!})"></div>
                                        @endif
                                        <i class="symbol-badge bg-success"></i>
                                    </div>
                                    <div>
                                        <a href="#"
                                           class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                                            {!! $teacher->teacher_full_name !!}
                                        </a>
                                        <div class="text-muted">
                                            @if($teacher->teacher_freeze =='on')
                                                {!! trans('teachers.frozen') !!}
                                            @else
                                                {!! trans('teachers.active') !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--end::User-->

                                <!--begin::Contact-->
                                <div class="py-9">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <a href="#"
                                           class="text-muted text-hover-primary">  {!! $teacher->teacher_bio !!}</a>
                                    </div>

                                </div>
                                <!--end::Contact-->

                                <!--begin::Nav-->
                                <div class="navi navi-bold  navi-active navi-link-rounded">
                                    <div class="navi-item mb-2">
                                        <a href="javascript:void(0);"
                                           class="navi-link py-4 active">
                                            <span class="navi-icon mr-2">
                                                <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Contact1.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24px" height="24px" viewBox="0 0 24 24"
                                                                    version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12"
                                                                    r="10"/>
                                                            <path
                                                                d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                                                                fill="#000000" opacity="0.3"/>
                                                            </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                        </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                                {!!  $teacher->teacher_gender !!}
                                              </span>
                                        </a>
                                    </div>


                                </div>
                                <!--end::Nav-->


                                <!--begin::Nav-->
                                <div class="navi navi-bold  navi-active navi-link-rounded">
                                    <div class="navi-item mb-2">
                                        <a href="javascript:void(0);"
                                           class="navi-link py-4 active">
                                            <span class="navi-icon mr-2">
                                                     <span class="symbol-label">
                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Dial-numbers.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4"
                                                      rx="2"/>
                                                <rect fill="#000000" x="4" y="10" width="4" height="4" rx="2"/>
                                                <rect fill="#000000" x="10" y="4" width="4" height="4" rx="2"/>
                                                <rect fill="#000000" x="10" y="10" width="4" height="4" rx="2"/>
                                                <rect fill="#000000" x="16" y="4" width="4" height="4" rx="2"/>
                                                <rect fill="#000000" x="16" y="10" width="4" height="4" rx="2"/>
                                                <rect fill="#000000" x="4" y="16" width="4" height="4" rx="2"/>
                                                <rect fill="#000000" x="10" y="16" width="4" height="4" rx="2"/>
                                                <rect fill="#000000" x="16" y="16" width="4" height="4" rx="2"/>
                                                </g>
                                                </svg><!--end::Svg Icon--></span>
                                                </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                                {!!  $teacher->teacher_qualification !!}
                                              </span>
                                        </a>
                                    </div>


                                </div>
                                <!--end::Nav-->


                                <!--begin::Nav-->
                                <div class="navi navi-bold  navi-active navi-link-rounded">
                                    <div class="navi-item mb-2">
                                        <a href="javascript:void(0);"
                                           class="navi-link py-4 active">
                                            <span class="navi-icon mr-2">
                                                         <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\iPhone-X.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24px" height="24px" viewBox="0 0 24 24"
                                                                    version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path
                                                                d="M8,2.5 C7.30964406,2.5 6.75,3.05964406 6.75,3.75 L6.75,20.25 C6.75,20.9403559 7.30964406,21.5 8,21.5 L16,21.5 C16.6903559,21.5 17.25,20.9403559 17.25,20.25 L17.25,3.75 C17.25,3.05964406 16.6903559,2.5 16,2.5 L8,2.5 Z"
                                                                fill="#000000" opacity="0.3"/>
                                                            <path
                                                                d="M8,2.5 C7.30964406,2.5 6.75,3.05964406 6.75,3.75 L6.75,20.25 C6.75,20.9403559 7.30964406,21.5 8,21.5 L16,21.5 C16.6903559,21.5 17.25,20.9403559 17.25,20.25 L17.25,3.75 C17.25,3.05964406 16.6903559,2.5 16,2.5 L8,2.5 Z M8,1 L16,1 C17.5187831,1 18.75,2.23121694 18.75,3.75 L18.75,20.25 C18.75,21.7687831 17.5187831,23 16,23 L8,23 C6.48121694,23 5.25,21.7687831 5.25,20.25 L5.25,3.75 C5.25,2.23121694 6.48121694,1 8,1 Z M9.5,1.75 L14.5,1.75 C14.7761424,1.75 15,1.97385763 15,2.25 L15,3.25 C15,3.52614237 14.7761424,3.75 14.5,3.75 L9.5,3.75 C9.22385763,3.75 9,3.52614237 9,3.25 L9,2.25 C9,1.97385763 9.22385763,1.75 9.5,1.75 Z"
                                                                fill="#000000" fill-rule="nonzero"/>
                                                            </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                        </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                               {!! $teacher->teacher_mobile_no!!}
                                              </span>
                                        </a>
                                    </div>


                                </div>
                                <!--end::Nav-->

                                <!--begin::Nav-->
                                <div class="navi navi-bold  navi-active navi-link-rounded">
                                    <div class="navi-item mb-2">
                                        <a href="javascript:void(0);"
                                           class="navi-link py-4 active">
                                            <span class="navi-icon mr-2">
                                                            <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Call.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24px" height="24px" viewBox="0 0 24 24"
                                                                    version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path
                                                                d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M11.613922,13.2130341 C11.1688026,13.6581534 10.4887934,13.7685037 9.92575695,13.4869855 C9.36272054,13.2054673 8.68271128,13.3158176 8.23759191,13.760937 L6.72658218,15.2719467 C6.67169475,15.3268342 6.63034033,15.393747 6.60579393,15.4673862 C6.51847004,15.7293579 6.66005003,16.0125179 6.92202169,16.0998418 L8.27584113,16.5511149 C9.57592638,16.9844767 11.009274,16.6461092 11.9783003,15.6770829 L15.9775173,11.6778659 C16.867756,10.7876271 17.0884566,9.42760861 16.5254202,8.3015358 L15.8928491,7.03639343 C15.8688153,6.98832598 15.8371895,6.9444475 15.7991889,6.90644684 C15.6039267,6.71118469 15.2873442,6.71118469 15.0920821,6.90644684 L13.4995401,8.49898884 C13.0544207,8.94410821 12.9440704,9.62411747 13.2255886,10.1871539 C13.5071068,10.7501903 13.3967565,11.4301996 12.9516371,11.8753189 L11.613922,13.2130341 Z"
                                                                fill="#000000"/>
                                                            </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                        </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                             {!! $teacher->teacher_whatsapp_no!!}
                                              </span>
                                        </a>
                                    </div>


                                </div>
                                <!--end::Nav-->


                                <!--begin::Nav-->
                                <div class="navi navi-bold  navi-active navi-link-rounded">
                                    <div class="navi-item mb-2">
                                        <a href="{!!  $teacher->teacher_photos_and_videos_link!!}" target="_blank"
                                           class="navi-link py-4 active">
                                            <span class="navi-icon mr-2">
                                                            <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Files\Pictures1.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24px" height="24px" viewBox="0 0 24 24"
                                                                    version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path
                                                                d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z"
                                                                fill="#000000" opacity="0.3"/>
                                                            <polygon fill="#000000" opacity="0.3"
                                                                     points="4 19 10 11 16 19"/>
                                                            <polygon fill="#000000" points="11 19 15 14 19 19"/>
                                                            <path
                                                                d="M18,12 C18.8284271,12 19.5,11.3284271 19.5,10.5 C19.5,9.67157288 18.8284271,9 18,9 C17.1715729,9 16.5,9.67157288 16.5,10.5 C16.5,11.3284271 17.1715729,12 18,12 Z"
                                                                fill="#000000" opacity="0.3"/>
                                                            </g>
                                                            </svg><!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                                   {!! trans('teachers.teacher_photos_and_videos_link')!!}

                                              </span>
                                        </a>
                                    </div>


                                </div>
                                <!--end::Nav-->

                                <!--begin::Nav-->
                                <div class="navi navi-bold  navi-active navi-link-rounded">
                                    <div class="navi-item mb-2">
                                        <a href="{!!   \Illuminate\Support\Facades\Storage::url($teacher->teacher_cv) !!}"
                                           target="_blank"
                                           class="navi-link py-4 active">
                                            <span class="navi-icon mr-2">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Adress-book2.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24px" height="24px" viewBox="0 0 24 24"
                                                                    version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path
                                                                d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z"
                                                                fill="#000000" opacity="0.3"/>
                                                            <path
                                                                d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
                                                                fill="#000000"/>
                                                            </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                         </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                                   {!! trans('teachers.teacher_cv')!!}

                                              </span>
                                        </a>
                                    </div>


                                </div>
                                <!--end::Nav-->

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Profile Card-->
                    </div>
                    <!--end::Aside-->


                    <!--begin::Content-->
                    <div class="flex-row-fluid ml-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                            @include('teacher.profile.categories')
                            @include('teacher.profile.notifications')

                        </div>
                        <!--end::Row-->
                        @include('teacher.profile.courses')

                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Profile Overview-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->


    <!--end::Main-->

@endsection
