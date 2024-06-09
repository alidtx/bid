<div class="app-sidebar sidebar-shadow bg-warning sidebar-text-dark">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                
                @hasanyrole(\App\Enums\RoleEnum::SUPERADMIN.'|'.\App\Enums\RoleEnum::ADMIN)
                <li class="app-sidebar__heading">Dashboard</li>
                <li>
                    <a href="{{route('home')}}" class="{{ Route::is('home') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Home
                    </a>
                </li>

                <li class="app-sidebar__heading">User Management</li>
                <li class="{{Route::is('users.*') ? 'mm-active' : ''}} {{Route::is('roles.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Users and roles
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>

                        <li>
                            <a href="{{route('users.index')}}"
                                class="{{ Route::is('users.index') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                User List
                            </a>
                        </li>

                        <li>
                            <a href="{{route('users.create')}}"
                                class="{{ Route::is('users.create') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon">
                                </i>
                                Add User
                            </a>
                        </li>
                        <li>
                            <a href="{{route('roles.index')}}"
                                class="{{ Route::is('roles.index') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Role List
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="app-sidebar__heading">Participant Management</li>
                <li class="{{Route::is('report.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Participant
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('report.participant')}}"
                                class="{{ Route::is('report.participant') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Participant Report
                            </a>
                        </li>
                        <li>
                            <a href="{{route('report.participant-add')}}" class="{{ Route::is('report.participant-add') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Participant Entry
                            </a>
                        </li>

                        
                    </ul>

                   
                </li>

               

                <li class="app-sidebar__heading">Sms Management</li>
                <li class="{{Route::is('sms.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        SMS
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>

                    <ul>
                        <li>
                            <a href="{{route('sms.send')}}"
                                class="{{ Route::is('sms.send') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Send Sms
                            </a>
                        </li>

                        <li>
                            <a href="{{route('report.sms-log')}}"
                                class="{{ Route::is('report.sms-log') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Sms Log Report
                            </a>
                        </li>

                        <li>
                            <a href="{{route('report.sent-sms-log')}}"
                                class="{{ Route::is('report.sent-sms-log') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Sent Sms Log Report
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="app-sidebar__heading">Division</li>
                <li class="{{Route::is('sms.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Division
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>

                    <ul>
                        <li>
                            <a href="{{route('division.list')}}"
                                class="{{ Route::is('division.list') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Division List
                            </a>
                        </li>

                    </ul>
                </li>    

                <li class="app-sidebar__heading">Quiz</li>
                <li class="{{Route::is('report.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Quiz
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>

                    <ul>
                        <li>
                            <a href="{{route('report.quiz')}}"
                                class="{{ Route::is('report.quiz') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Quiz Sms Log List
                            </a>
                        </li>

                    </ul>
                </li>  
                @endhasanyrole
                @hasanyrole(\App\Enums\RoleEnum::CALLCENTER)

                <li class="app-sidebar__heading">Call Center</li>
                <li class="{{Route::is('report.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Participant Call Center
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('report.participant.call-center')}}"
                                class="{{ Route::is('report.participant.call-center') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Call Center Report
                            </a>
                        </li>
                        
                    </ul>

                   
                </li>
                @endhasanyrole


                
               @if (Auth::user()->can('Add-Participant'))
               <li class="app-sidebar__heading"> Add Participant</li>
                <li class="{{Route::is('report.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Participant
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('report.participant-add')}}" class="{{ Route::is('report.participant-add') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Participant Entry
                            </a>
                        </li>

                    </ul>

                </li>


               @endif
               


                @hasanyrole(\App\Enums\RoleEnum::EDITOR.'|'.\App\Enums\RoleEnum::VIEWER)


                <li class="app-sidebar__heading">Dashboard</li>
                <li>
                    <a href="{{route('home')}}" class="{{ Route::is('home') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Home
                    </a>
                </li>

               

                

                <li class="app-sidebar__heading">Sms Management</li>
                <li class="{{Route::is('sms.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        SMS
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>

                    <ul>
                        <li>
                            <a href="{{route('sms.send')}}"
                                class="{{ Route::is('sms.send') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Send Sms
                            </a>
                        </li>

                        <li>
                            <a href="{{route('report.sms-log')}}"
                                class="{{ Route::is('report.sms-log') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Sms Log Report
                            </a>
                        </li>

                        <li>
                            <a href="{{route('report.sent-sms-log')}}"
                                class="{{ Route::is('report.sent-sms-log') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                               Sent Sms Log Report
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="app-sidebar__heading">Division</li>
                <li class="{{Route::is('sms.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Division
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>

                    <ul>
                        <li>
                            <a href="{{route('division.list')}}"
                                class="{{ Route::is('division.list') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Division List
                            </a>
                        </li>

                    </ul>
                </li>    

                <li class="app-sidebar__heading">Quiz</li>
                <li class="{{Route::is('report.*') ? 'mm-active' : ''}}">
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Quiz
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>

                    <ul>
                        <li>
                            <a href="{{route('report.quiz')}}"
                                class="{{ Route::is('report.quiz') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Quiz Sms Log List
                            </a>
                        </li>

                    </ul>
                </li>  

               @endhasanyrole
              
            </ul>
        </div>
    </div>
</div>
