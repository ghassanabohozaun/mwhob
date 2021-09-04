<div class="col-lg-3">
    <div class="left-list-cp">


        <div class="content-user">
            <div class="flex-with-img d-flex">

                @if(student()->user()->photo == null)
                    @if(student()->user()->mowhob_gender ==  trans('general.male'))
                        <div class="img-user">
                            <img src="{{asset('adminBoard/images/male.jpeg')}}" alt="">
                        </div>
                    @else
                        <div class="img-user">
                            <img src="{{asset('adminBoard/images/female.jpeg')}}" alt="">
                        </div>
                    @endif
                @else
                    <div class="img-user">
                        <img src="{!! Storage::url(student()->user()->photo) !!}" alt="">
                    </div>
                @endif


                <div class="name-title">
                    <div class="name">{!! student()->user()->mawhob_full_name !!}</div>
                    <div class="title">
                        {!!Lang()=='ar'?student()->user()->category->name_ar:student()->user()->category->name_en !!}
                    </div>
                </div>
            </div>
            <div class="list-contact-icons">
                <ul>
                    <li>
                        <span class="icon">
                          <i class="far fa-calendar-alt"></i>
                         </span>
                        <span class="text">{!! student()->user()->mawhob_birthday !!}</span>
                    </li>
                    <li>
                        <span class="icon"><i class="fas fa-phone"></i></span> <span
                            class="text">{!! student()->user()->mawhob_mobile_no !!}</span>
                    </li>
                    <li>
                        <span class="icon"><i class="fab fa-whatsapp"></i></span> <span
                            class="text">{!! student()->user()->mawhob_whatsapp_no !!}</span>
                    </li>
                </ul>
            </div>
        </div>


        <div class="list-links-pages p-4 bg-light">
            <ul>
                <li>
                    <a href="{!! route('student.portfolio') !!}"
                       class="@if(str_contains(url()->current(), 'portfolio')) active @endif">
                        <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30.517"
                                                height="25.5" viewBox="0 0 30.517 25.5"><defs><style>.a {
                                            fill: #f28705;
                                            stroke: #f28705;
                                            stroke-width: 0.5px;
                                        }</style></defs><g transform="translate(0.299 -1.75)"><g
                                        transform="translate(0.007 5.745)"><path class="a"
                                                                                 d="M26.841,26.255H3.121A3.093,3.093,0,0,1,0,23.129v-15A3.093,3.093,0,0,1,3.121,5h23.72a3.093,3.093,0,0,1,3.121,3.126v15A3.093,3.093,0,0,1,26.841,26.255Zm-23.72-20A1.921,1.921,0,0,0,1.248,8.126v15A1.921,1.921,0,0,0,3.121,25h23.72a1.921,1.921,0,0,0,1.873-1.875v-15A1.921,1.921,0,0,0,26.841,6.25Z"
                                                                                 transform="translate(0 -5)"/></g><g
                                        transform="translate(9.994 2)"><path class="a"
                                                                             d="M17.363,6.994a.59.59,0,0,1-.624-.624v-2.5a.59.59,0,0,0-.624-.624H9.873a.59.59,0,0,0-.624.624v2.5A.624.624,0,0,1,8,6.369v-2.5A1.92,1.92,0,0,1,9.873,2h6.242a1.92,1.92,0,0,1,1.873,1.873v2.5A.59.59,0,0,1,17.363,6.994Z"
                                                                             transform="translate(-8 -2)"/></g><g
                                        transform="translate(-0.027 10.707)"><path class="a"
                                                                                   d="M14.87,15.251.381,10.258a.762.762,0,0,1-.375-.874.762.762,0,0,1,.874-.375L14.988,14,29.095,9.009a.523.523,0,0,1,.749.375.523.523,0,0,1-.375.749L15.258,15.251C14.87,15.334,15,15.251,14.87,15.251Z"
                                                                                   transform="translate(0.027 -8.962)"/></g></g></svg></span>
                        <span class="title">{!! trans('site.portfolio') !!}</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('student.courses') !!}"
                       class="@if(str_contains(url()->current(), 'courses')) active @endif">
                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                    height="30" viewBox="0 0 30 30">
                            <g id="Courses" transform="translate(0 -0.474)">
                            <g id="Group_41166" data-name="Group 41166" transform="translate(-599 -994.526)">
                            <rect id="Rectangle_1568" data-name="Rectangle 1568" width="30" height="30"
                                  transform="translate(599 995)" fill="none"/>
                            <g id="online-course" transform="translate(599 995.357)">
                            <path id="Path_28" data-name="Path 28"
                                  d="M21,17a.5.5,0,0,1-.213-.047l-8.5-4a.5.5,0,0,1,0-.905l8.5-4a.5.5,0,0,1,.426,0l8.5,4a.5.5,0,0,1,0,.905l-8.5,4A.5.5,0,0,1,21,17Zm-7.325-4.5L21,15.947,28.326,12.5,21,9.052Z"
                                  transform="translate(-6 -4)" fill="#f28705"/>
                            <path id="Path_29" data-name="Path 29"
                                  d="M23.5,26.177a.5.5,0,0,1-.223-.052l-6-3A.5.5,0,0,1,17,22.677V18.853a.5.5,0,0,1,.713-.452L23.5,21.124,29.287,18.4a.5.5,0,0,1,.713.452v3.824a.5.5,0,0,1-.277.448l-6,3A.5.5,0,0,1,23.5,26.177Z"
                                  transform="translate(-8.5 -9.177)" fill="#f28705"/>
                            <path id="Path_30" data-name="Path 30"
                                  d="M38,17H29.5a.5.5,0,0,1,0-1H38a.5.5,0,0,1,0,1Z"
                                  transform="translate(-14.5 -8)" fill="#f28705"/>
                            <path id="Path_31" data-name="Path 31"
                                  d="M46.5,21.5A.5.5,0,0,1,46,21V16.5a.5.5,0,0,1,1,0V21A.5.5,0,0,1,46.5,21.5Z"
                                  transform="translate(-23 -8)" fill="#f28705"/>
                            <path id="Path_32" data-name="Path 32"
                                  d="M29.5,17a.5.5,0,0,1-.5-.5v-2a.5.5,0,0,1,1,0v2A.5.5,0,0,1,29.5,17Z"
                                  transform="translate(-14.5 -7)" fill="#f28705"/>
                            <path id="Path_33" data-name="Path 33"
                                  d="M44.5,27.5a.5.5,0,0,1-.416-.778l1-1.5a.5.5,0,0,1,.832.555l-1,1.5A.5.5,0,0,1,44.5,27.5Z"
                                  transform="translate(-22 -12.499)" fill="#f28705"/>
                            <path id="Path_34" data-name="Path 34"
                                  d="M47.5,27.5a.5.5,0,0,1-.417-.222l-1-1.5a.5.5,0,0,1,.832-.555l1,1.5a.5.5,0,0,1-.416.777Z"
                                  transform="translate(-23 -12.499)" fill="#f28705"/>
                            <path id="Path_35" data-name="Path 35"
                                  d="M29.5,26.5A.5.5,0,0,1,29,26V24.5a.5.5,0,1,1,1,0V26A.5.5,0,0,1,29.5,26.5Z"
                                  transform="translate(-14.5 -12)" fill="#f28705"/>
                            <path id="Path_36" data-name="Path 36"
                                  d="M29.5,19H.5a.5.5,0,0,1-.5-.5V2A2,2,0,0,1,2,0H28a2,2,0,0,1,2,2V18.5A.5.5,0,0,1,29.5,19ZM1,18H29V2a1,1,0,0,0-1-1H2A1,1,0,0,0,1,2Z"
                                  transform="translate(0 0)" fill="#f28705"/>
                            <path id="Path_37" data-name="Path 37"
                                  d="M28,41H2a2,2,0,0,1-2-2V36.5A.5.5,0,0,1,.5,36h29a.5.5,0,0,1,.5.5V39A2,2,0,0,1,28,41Z"
                                  transform="translate(0 -18)" fill="#f28705"/>
                            <path id="Path_38" data-name="Path 38"
                                  d="M29.5,41h-3a.5.5,0,0,1,0-1h3a.5.5,0,1,1,0,1Z"
                                  transform="translate(-13 -20)" fill="#f28705"/>
                            <path id="Path_39" data-name="Path 39"
                                  d="M29.5,21H4.5a.5.5,0,0,1-.5-.5V4.5A.5.5,0,0,1,4.5,4h25a.5.5,0,0,1,.5.5v16A.5.5,0,0,1,29.5,21ZM5,20H29V5H5Z"
                                  transform="translate(-2 -2)" fill="#f28705"/>
                            <path id="Path_40" data-name="Path 40"
                                  d="M28.5,55h-13a1.5,1.5,0,0,1,0-3h13a1.5,1.5,0,1,1,0,3Z"
                                  transform="translate(-7 -26)" fill="#f28705"/>
                            <path id="Path_41" data-name="Path 41"
                                  d="M18,48.5a.5.5,0,0,1,.5-.5c1.659,0,2.5-1.177,2.5-3.5a.5.5,0,0,1,.5-.5h5a.5.5,0,0,1,.5.5c0,2.323.841,3.5,2.5,3.5a.5.5,0,0,1,.5.5C30,48.776,18,48.776,18,48.5Zm2.935-.5h6.13a4.785,4.785,0,0,1-1.051-3H21.986A4.787,4.787,0,0,1,20.935,48Z"
                                  transform="translate(-9 -22)" fill="#f28705"/>
                            </g>
                            </g>
                            </g>
                            </svg></span>
                        <span class="title">
                            {!! trans('site.courses') !!}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('student.programs') !!}"
                       class="@if(str_contains(url()->current(), 'programs')) active @endif">
                            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                    height="30" viewBox="0 0 30 30">
                            <g id="Courses" transform="translate(0 -0.474)">
                            <g id="Group_41166" data-name="Group 41166" transform="translate(-599 -994.526)">
                            <rect id="Rectangle_1568" data-name="Rectangle 1568" width="30" height="30"
                                  transform="translate(599 995)" fill="none"/>
                            <g id="online-course" transform="translate(599 995.357)">
                            <path id="Path_28" data-name="Path 28"
                                  d="M21,17a.5.5,0,0,1-.213-.047l-8.5-4a.5.5,0,0,1,0-.905l8.5-4a.5.5,0,0,1,.426,0l8.5,4a.5.5,0,0,1,0,.905l-8.5,4A.5.5,0,0,1,21,17Zm-7.325-4.5L21,15.947,28.326,12.5,21,9.052Z"
                                  transform="translate(-6 -4)" fill="#f28705"/>
                            <path id="Path_29" data-name="Path 29"
                                  d="M23.5,26.177a.5.5,0,0,1-.223-.052l-6-3A.5.5,0,0,1,17,22.677V18.853a.5.5,0,0,1,.713-.452L23.5,21.124,29.287,18.4a.5.5,0,0,1,.713.452v3.824a.5.5,0,0,1-.277.448l-6,3A.5.5,0,0,1,23.5,26.177Z"
                                  transform="translate(-8.5 -9.177)" fill="#f28705"/>
                            <path id="Path_30" data-name="Path 30"
                                  d="M38,17H29.5a.5.5,0,0,1,0-1H38a.5.5,0,0,1,0,1Z"
                                  transform="translate(-14.5 -8)" fill="#f28705"/>
                            <path id="Path_31" data-name="Path 31"
                                  d="M46.5,21.5A.5.5,0,0,1,46,21V16.5a.5.5,0,0,1,1,0V21A.5.5,0,0,1,46.5,21.5Z"
                                  transform="translate(-23 -8)" fill="#f28705"/>
                            <path id="Path_32" data-name="Path 32"
                                  d="M29.5,17a.5.5,0,0,1-.5-.5v-2a.5.5,0,0,1,1,0v2A.5.5,0,0,1,29.5,17Z"
                                  transform="translate(-14.5 -7)" fill="#f28705"/>
                            <path id="Path_33" data-name="Path 33"
                                  d="M44.5,27.5a.5.5,0,0,1-.416-.778l1-1.5a.5.5,0,0,1,.832.555l-1,1.5A.5.5,0,0,1,44.5,27.5Z"
                                  transform="translate(-22 -12.499)" fill="#f28705"/>
                            <path id="Path_34" data-name="Path 34"
                                  d="M47.5,27.5a.5.5,0,0,1-.417-.222l-1-1.5a.5.5,0,0,1,.832-.555l1,1.5a.5.5,0,0,1-.416.777Z"
                                  transform="translate(-23 -12.499)" fill="#f28705"/>
                            <path id="Path_35" data-name="Path 35"
                                  d="M29.5,26.5A.5.5,0,0,1,29,26V24.5a.5.5,0,1,1,1,0V26A.5.5,0,0,1,29.5,26.5Z"
                                  transform="translate(-14.5 -12)" fill="#f28705"/>
                            <path id="Path_36" data-name="Path 36"
                                  d="M29.5,19H.5a.5.5,0,0,1-.5-.5V2A2,2,0,0,1,2,0H28a2,2,0,0,1,2,2V18.5A.5.5,0,0,1,29.5,19ZM1,18H29V2a1,1,0,0,0-1-1H2A1,1,0,0,0,1,2Z"
                                  transform="translate(0 0)" fill="#f28705"/>
                            <path id="Path_37" data-name="Path 37"
                                  d="M28,41H2a2,2,0,0,1-2-2V36.5A.5.5,0,0,1,.5,36h29a.5.5,0,0,1,.5.5V39A2,2,0,0,1,28,41Z"
                                  transform="translate(0 -18)" fill="#f28705"/>
                            <path id="Path_38" data-name="Path 38"
                                  d="M29.5,41h-3a.5.5,0,0,1,0-1h3a.5.5,0,1,1,0,1Z"
                                  transform="translate(-13 -20)" fill="#f28705"/>
                            <path id="Path_39" data-name="Path 39"
                                  d="M29.5,21H4.5a.5.5,0,0,1-.5-.5V4.5A.5.5,0,0,1,4.5,4h25a.5.5,0,0,1,.5.5v16A.5.5,0,0,1,29.5,21ZM5,20H29V5H5Z"
                                  transform="translate(-2 -2)" fill="#f28705"/>
                            <path id="Path_40" data-name="Path 40"
                                  d="M28.5,55h-13a1.5,1.5,0,0,1,0-3h13a1.5,1.5,0,1,1,0,3Z"
                                  transform="translate(-7 -26)" fill="#f28705"/>
                            <path id="Path_41" data-name="Path 41"
                                  d="M18,48.5a.5.5,0,0,1,.5-.5c1.659,0,2.5-1.177,2.5-3.5a.5.5,0,0,1,.5-.5h5a.5.5,0,0,1,.5.5c0,2.323.841,3.5,2.5,3.5a.5.5,0,0,1,.5.5C30,48.776,18,48.776,18,48.5Zm2.935-.5h6.13a4.785,4.785,0,0,1-1.051-3H21.986A4.787,4.787,0,0,1,20.935,48Z"
                                  transform="translate(-9 -22)" fill="#f28705"/>
                            </g>
                            </g>
                            </g>
                            </svg></span>
                        <span class="title">
                            {!! trans('site.programs') !!}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('student.contests') !!}"
                       class="@if(str_contains(url()->current(), 'contests')) active @endif">
                        <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.77" height="30"
                             viewBox="0 0 22.77 30">
                        <g id="Contests" transform="translate(-10 -3.028)">
                        <path id="Path_3067" data-name="Path 3067"
                              d="M28.728,38.216l1.1,7.148h1.182l1.1-7.148-1.693-1.042Z"
                              transform="translate(-9.036 -16.476)" fill="#f28705"/>
                        <path id="Path_3068" data-name="Path 3068"
                              d="M29.972,55v.517A1.554,1.554,0,0,1,28.42,57.07H20.14a1.554,1.554,0,0,1-1.552-1.552V55H17.8L16,57.252V58.1H32.56v-.853L30.759,55Z"
                              transform="translate(-2.895 -25.077)" fill="#f28705"/>
                        <path id="Path_3069" data-name="Path 3069"
                              d="M37.333,41.036l-1.156-.711-1.011,6.559h1.039Z"
                              transform="translate(-12.143 -17.996)" fill="#f28705"/>
                        <path id="Path_3070" data-name="Path 3070"
                              d="M32.594,10.776H24.117L21.575,3.151a.209.209,0,0,0-.381,0l-2.541,7.625H10.176a.176.176,0,0,0-.107.316L16.8,16.273l-2.081,7.283,6.661-4.072,6.641,4.087-2.061-7.3L32.7,11.091a.176.176,0,0,0-.107-.316Zm-8.411,4.909,1.282,4.486-4.08-2.511L17.3,20.171l1.282-4.486-4.363-3.356h5.549l1.613-4.839L23,12.328h5.549Z"
                              fill="#f28705"/>
                        <path id="Path_3071" data-name="Path 3071"
                              d="M23,55.517a.518.518,0,0,0,.517.517H31.8a.518.518,0,0,0,.517-.517V55H23Z"
                              transform="translate(-6.273 -25.077)" fill="#f28705"/>
                        <path id="Path_3072" data-name="Path 3072"
                              d="M24.647,41.036l1.128,5.848h1.039L25.8,40.325Z"
                              transform="translate(-7.067 -17.996)" fill="#f28705"/>
                        </g>
                        </svg>

                        </span>
                        <span class="title">
                            {!! trans('site.contests') !!}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('student.update.account') !!}"
                       class="@if(str_contains(url()->current(), 'update-account')) active @endif">
                        <span class="icon">
                            <img src="{!! asset('site/img/profile.png') !!}">
                        </span>
                        <span class="title">
                            {!! trans('site.update_account') !!}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('student.logout') !!}">
                        <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                height="30.001" viewBox="0 0 30 30.001"><defs><style>.a {
                                            fill: #f28705;
                                        }</style></defs><path class="a"
                                                              d="M21.653,22.97v2.344A4.693,4.693,0,0,1,16.966,30H5.188A4.693,4.693,0,0,1,.5,25.314V4.688A4.693,4.693,0,0,1,5.188,0H16.966a4.693,4.693,0,0,1,4.688,4.688V7.032a1.172,1.172,0,1,1-2.344,0V4.688a2.347,2.347,0,0,0-2.344-2.344H5.188A2.347,2.347,0,0,0,2.844,4.688V25.314a2.347,2.347,0,0,0,2.344,2.344H16.966a2.347,2.347,0,0,0,2.344-2.344V22.97a1.172,1.172,0,1,1,2.344,0Zm7.99-9.982-2.624-2.624a1.172,1.172,0,0,0-1.657,1.657l1.867,1.867H13.157a1.172,1.172,0,1,0,0,2.344H27.228L25.362,18.1a1.172,1.172,0,1,0,1.657,1.657l2.624-2.624a2.933,2.933,0,0,0,0-4.143Zm0,0"
                                                              transform="translate(-0.5)"/></svg></span>
                        <span class="title">
                            {!! trans('site.logout') !!}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
