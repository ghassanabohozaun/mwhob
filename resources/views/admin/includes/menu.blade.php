<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div style="margin-top:18px"
         id="kt_aside_menu"
         class="aside-menu "
         data-menu-vertical="1"
         data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->

        <ul class="menu-nav ">
            @can('dashboard')
                <li class="menu-item  menu-item-active" aria-haspopup="true" style="height: 40px;">
                    <a href="{{route('admin.dashboard')}}" class="menu-link ">
                    <span class="svg-icon menu-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Layout\Layout-grid.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <rect fill="#000000" opacity="0.3" x="4" y="4" width="4" height="4" rx="1"/>
                            <path
                                d="M5,10 L7,10 C7.55228475,10 8,10.4477153 8,11 L8,13 C8,13.5522847 7.55228475,14 7,14 L5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 L14,7 C14,7.55228475 13.5522847,8 13,8 L11,8 C10.4477153,8 10,7.55228475 10,7 L10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,13 C14,13.5522847 13.5522847,14 13,14 L11,14 C10.4477153,14 10,13.5522847 10,13 L10,11 C10,10.4477153 10.4477153,10 11,10 Z M17,4 L19,4 C19.5522847,4 20,4.44771525 20,5 L20,7 C20,7.55228475 19.5522847,8 19,8 L17,8 C16.4477153,8 16,7.55228475 16,7 L16,5 C16,4.44771525 16.4477153,4 17,4 Z M17,10 L19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 L17,14 C16.4477153,14 16,13.5522847 16,13 L16,11 C16,10.4477153 16.4477153,10 17,10 Z M5,16 L7,16 C7.55228475,16 8,16.4477153 8,17 L8,19 C8,19.5522847 7.55228475,20 7,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,17 C4,16.4477153 4.44771525,16 5,16 Z M11,16 L13,16 C13.5522847,16 14,16.4477153 14,17 L14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 L10,17 C10,16.4477153 10.4477153,16 11,16 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z"
                                fill="#000000"/>
                            </g>
                            </svg><!--end::Svg Icon--></span>
                    </span>
                        <span class="menu-text">{{trans('menu.dashboard')}}</span></a>
                </li>
                <li class="menu-section" style="margin-bottom: -10px"></li>
            @endcan

            <li class="menu-item  menu-item-submenu
                    @if(str_contains(url()->current(), 'settings')
                            || str_contains(url()->current(), '/admin/admin')
                            || str_contains(url()->current(), '/admin/regions')) menu-item-open @endif"
                aria-haspopup="true" data-menu-toggle="hover"
                style="margin-top: -25px">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Home.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path
                                d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z"
                                fill="#000000"/>
                            </g>
                            </svg><!--end::Svg Icon--></span>
                    </span>
                    <span class="menu-text">{{trans('menu.home')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu ">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">

                        @can('settings')
                            <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{route('get.admin.settings')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{trans('menu.settings')}}</span>
                                </a>
                            </li>
                        @endcan

                        @can('admins')
                            <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{route('get.admin')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{trans('menu.admin')}}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>

            <!------------------------------------ Roles  ---------------------------------------------------->
            @can('roles')
                <li class="menu-item  menu-item-submenu"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{!! route('admin.roles') !!}" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Lock-circle.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                            <path
                                d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z"
                                fill="#000000"/>
                            </g>
                            </svg><!--end::Svg Icon--></span>
                    </span>
                        <span class="menu-text">{{trans('menu.permissions')}}</span>
                        <span class="menu-label">
                        <span class="label label-rounded label-success">
                             {{App\Models\Role::count()}}
                        </span>
                    </span>
                    </a>
                </li>
            @endcan

        <!------------------------------------ Users    ---------------------------------------------------->
            @can('users')
                <li class="menu-item  menu-item-submenu
                 @if(str_contains(url()->current(), '/users')
                     || str_contains(url()->current(), '/mowhobs')
                      || str_contains(url()->current(), '/teachers')) menu-item-open @endif"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Group.svg--><svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path
                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path
                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                            fill="#000000" fill-rule="nonzero"/>
                        </g>
                        </svg><!--end::Svg Icon--></span>
                    </span>
                        <span class="menu-text">{{trans('menu.users')}}</span>
                        <i class="menu-arrow"></i>
                        <span class="menu-label">
                        <span class="label label-rounded label-info">
                           {{App\Models\Admin::withTrashed()->where('id', '!=', \auth('admin')->user()->id)->count()}}
                        </span>
                    </span>

                    </a>
                    <div class="menu-submenu ">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">{{trans('menu.users')}}</span>
                            </span>
                            </li>


                            <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{route('users')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{trans('menu.users')}}</span>
                                    <span class="menu-label">
                                    <span class="label label-rounded label-info">
                                        {{App\Models\Admin::withoutTrashed()->where('id', '!=', \auth('admin')->user()->id)->count()}}
                                    </span>
                                </span>
                                </a>
                            </li>

                            <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{route('admin.mowhobs')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{trans('menu.mowhobs')}}</span>
                                    <span class="menu-label">
                                    <span class="label label-rounded label-info">
                                        {{App\Models\Mawhob::count()}}
                                    </span>
                                </span>
                                </a>
                            </li>


                            <li class="menu-item  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{route('admin.teachers')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">{{trans('menu.teachers')}}</span>
                                    <span class="menu-label">
                                    <span class="label label-rounded label-info">
                                        {{App\Models\Teacher::count()}}
                                    </span>
                                </span>
                                </a>
                            </li>
                        </ul>
                    </div>


                </li>
            @endcan
        <!------------------------------------ Categories  ---------------------------------------------------->
            @can('categories')
                <li class="menu-item  menu-item-submenu"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{!! route('admin.categories') !!}" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Layout\Layout-4-blocks.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"/>
                            <path
                                d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                fill="#000000" opacity="0.3"/>
                            </g>
                            </svg><!--end::Svg Icon--></span>
                    </span>
                        <span class="menu-text">{{trans('menu.categories')}}</span>
                        <span class="menu-label">
                        <span class="label label-rounded label-warning">
                             {{App\Models\Category::count()}}
                        </span>
                    </span>
                    </a>
                </li>
            @endcan
        <!------------------------------------ Support Center  ---------------------------------------------------->
            @can('support-center')
                <li class="menu-item  menu-item-submenu"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{!! route('admin.support.center') !!}" class="menu-link menu-toggle">
                                <span class="svg-icon menu-icon">
                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Active-call.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path
                                    d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z"
                                    fill="#000000"/>
                                <path
                                    d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                </g>
                                </svg><!--end::Svg Icon--></span>
                    </span>
                        <span class="menu-text">{{trans('menu.support_center')}}</span>
                        <span class="menu-label">
                        <span class="label label-rounded label-white">
                             {{App\Models\SupportCenter::count()}}
                        </span>
                    </span>
                    </a>
                </li>
            @endcan
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>

