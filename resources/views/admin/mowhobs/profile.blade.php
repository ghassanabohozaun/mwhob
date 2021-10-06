@extends('layouts.admin')
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
                                <a href="{!! route('admin.mowhobs') !!}" class="text-muted">
                                    {{trans('menu.mowhobs')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">
                                    {{trans('mowhob.profile')}}
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
                                        @if(!$mowhob->photo)
                                            @if($mowhob->mowhob_gender == trans('general.male'))
                                                <div class="symbol-label"
                                                     style="background-image:url({!! asset('adminBoard/images/male.jpeg') !!})"></div>
                                            @else
                                                <div class="symbol-label"
                                                     style="background-image:url({!! asset('adminBoard/images/female.jpeg') !!})"></div>
                                            @endif
                                        @else
                                            <div class="symbol-label"
                                                 style="background-image:url({!! \Illuminate\Support\Facades\Storage::url($mowhob->photo) !!})"></div>
                                        @endif
                                        <i class="symbol-badge bg-success"></i>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)"
                                           class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                                            {!! $mowhob->mawhob_full_name !!}
                                        </a>

                                        <a href="javascript:void(0)" style="display: block ;margin-top: 3px"
                                           class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                                            {!! $mowhob->mawhob_full_name_en !!}
                                        </a>
                                        <div class="text-muted">
                                            @if($mowhob->freeze =='on')
                                                {!! trans('mowhob.active') !!}
                                            @else
                                                {!! trans('mowhob.frozen') !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!--end::User-->


                                <br/> <br/>

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
                                                {!!   $mowhob->mowhob_gender !!}
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
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
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
                                               {!!  $mowhob->mawhob_birthday !!}
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
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
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
                                              {!! $mowhob->mawhob_mobile_no!!}
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
                                            {!! $mowhob->mawhob_whatsapp_no!!}
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
                                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Mail-at.svg--><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        width="24px" height="24px"
                                                                        viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                   fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path
                                                                    d="M11.575,21.2 C6.175,21.2 2.85,17.4 2.85,12.575 C2.85,6.875 7.375,3.05 12.525,3.05 C17.45,3.05 21.125,6.075 21.125,10.85 C21.125,15.2 18.825,16.925 16.525,16.925 C15.4,16.925 14.475,16.4 14.075,15.65 C13.3,16.4 12.125,16.875 11,16.875 C8.25,16.875 6.85,14.925 6.85,12.575 C6.85,9.55 9.05,7.1 12.275,7.1 C13.2,7.1 13.95,7.35 14.525,7.775 L14.625,7.35 L17,7.35 L15.825,12.85 C15.6,13.95 15.85,14.825 16.925,14.825 C18.25,14.825 19.025,13.725 19.025,10.8 C19.025,6.9 15.95,5.075 12.5,5.075 C8.625,5.075 5.05,7.75 5.05,12.575 C5.05,16.525 7.575,19.1 11.575,19.1 C13.075,19.1 14.625,18.775 15.975,18.075 L16.8,20.1 C15.25,20.8 13.2,21.2 11.575,21.2 Z M11.4,14.525 C12.05,14.525 12.7,14.35 13.225,13.825 L14.025,10.125 C13.575,9.65 12.925,9.425 12.3,9.425 C10.65,9.425 9.45,10.7 9.45,12.375 C9.45,13.675 10.075,14.525 11.4,14.525 Z"
                                                                    fill="#000000"/>
                                                                </g>
                                                                </svg><!--end::Svg Icon--></span>
                                                            </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                            {!! $mowhob->mawhob_email!!}
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
                                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Flag.svg--><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        width="24px" height="24px" viewBox="0 0 24 24"
                                                                        version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                   fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path
                                                                    d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z"
                                                                    fill="#000000"/>
                                                                <path
                                                                    d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z"
                                                                    fill="#000000" opacity="0.3"/>
                                                                </g>
                                                                </svg><!--end::Svg Icon--></span>
                                                            </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                                {!! trans('countries.'.$mowhob->country) !!}
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
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Layout\Layout-4-blocks.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <rect fill="#000000" x="4" y="4" width="7" height="7"
                                                                  rx="1.5"></rect>
                                                            <path
                                                                d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                                fill="#000000" opacity="0.3"></path>
                                                            </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                        </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                               {!! Lang()=='ar'? $mowhob->category->name_ar : $mowhob->category->name_en !!}
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
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Difference.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px" height="24px" viewBox="0 0 24 24"
                                                                    version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path
                                                                d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z M17,16 L17,10 C17,8.34314575 15.6568542,7 14,7 L8,7 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L17,16 Z"
                                                                fill="#000000" fill-rule="nonzero"/>
                                                            <path
                                                                d="M9.27272727,9 L13.7272727,9 C14.5522847,9 15,9.44771525 15,10.2727273 L15,14.7272727 C15,15.5522847 14.5522847,16 13.7272727,16 L9.27272727,16 C8.44771525,16 8,15.5522847 8,14.7272727 L8,10.2727273 C8,9.44771525 8.44771525,9 9.27272727,9 Z"
                                                                fill="#000000" opacity="0.3"/>
                                                            </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                   </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                               {!! $mowhob->other_talents !!}
                                              </span>
                                        </a>
                                    </div>


                                </div>
                                <!--end::Nav-->

                                <!--begin::Nav-->
                                <div class="navi navi-bold  navi-active navi-link-rounded">
                                    <div class="navi-item mb-2">
                                        <a href="{!! $mowhob->portfolio!!}" target="_blank"
                                           class="navi-link py-4 active">
                                            <span class="navi-icon mr-2">
                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Adress-book2.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
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
                                            <span class="navi-text font-size-lg">
                                                   {!!trans('mowhob.show_portfolio')!!}

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
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Write.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px" height="24px" viewBox="0 0 24 24"
                                                                    version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path
                                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                            <path
                                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                            </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                         </span>
                                              </span>
                                            <span class="navi-text font-size-lg">
                                               @if($mowhob->agree_to_the_policy == 'on')
                                                    {!! trans('mowhob.policy_approved') !!}
                                                @else
                                                    <span style="color: red">
                                                      {!! trans('mowhob.policy_not_approved') !!}
                                                 </span>
                                                @endif
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


                        @include('admin.mowhobs.profile.contests')
                        @include('admin.mowhobs.profile.enrolled-courses')
                        @include('admin.mowhobs.profile.programs')


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
