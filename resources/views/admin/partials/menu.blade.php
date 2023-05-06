<div class="sidebar ">
    <nav class="sidebar-nav">

        <ul class="nav">
            <!-- <li >
                <a class="navbar-brand justify-content-center">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li> -->

            <!-- USER MANAGEMENT -->
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                        
                    
                    </ul>
                </li>
            @endcan  
            <!-- USER DICTIONARIES -->
            @can('user_dictionaries_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa fa-address-book nav-icon">

                        </i>
                        {{ trans('cruds.dictionaries.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
            @can('TaskType_access')
                <li class="nav-item">
                    <a href="{{ route("admin.tasktype.index") }}" class="nav-link {{ request()->is('admin/tasktype') || request()->is('admin/tasktype/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-tasks nav-icon">

                        </i>
                        {{ trans('cruds.category.fields.projects') }}
                    </a>
                </li>
            @endcan
            @can('TypeTask_access')
                <li class="nav-item">
                    <a href="{{ route("admin.typetask.index") }}" class="nav-link {{ request()->is('admin/typetask') || request()->is('admin/typetask/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-book nav-icon">

                        </i>
                        {{ trans('cruds.typetask.title_plulars') }}
                    </a>
                </li>
            @endcan
            @can('car_access')
                <li class="nav-item">
                    <a href="{{ route("admin.car.index") }}" class="nav-link {{ request()->is('admin/car') || request()->is('admin/car/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-car nav-icon">

                        </i>
                        Samochody
                    </a>
                </li>
            @endcan
                    </ul>
                </li>
            @endcan 
            <!-- COMPANY -->
            @can('company_access')
                <li class="nav-item">
                    <a href="{{ route("admin.companies.index") }}" class="nav-link {{ request()->is('admin/companies') || request()->is('admin/companies/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-handshake nav-icon">
                       
                        </i>
                        {{ trans('cruds.company.title') }}
                    </a>
                </li>
            @endcan
            <!-- RepEquipment -->
            @can('equipment_access')
                <li class="nav-item">
                    <a href="{{ route("admin.repequipment.index") }}" class="nav-link {{ request()->is('admin/repequipment') || request()->is('admin/repequipment/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-desktop nav-icon">

                        </i>
                        Sprzęt zast.
                    </a>
                </li>
            @endcan
            @can('job_access')
                <li class="nav-item">
                    <a href="{{ route("admin.jobs.index") }}" class="nav-link {{ request()->is('admin/jobs') || request()->is('admin/jobs/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-window-restore nav-icon"></i>


                        </i>
                        Zlecenia KC
                    </a>
                </li>
            @endcan
            @can('user_access')
                            <li class="nav-item">
                            <a href="{{ route("admin.ConfirmSystem.index") }}" class="nav-link {{ request()->is('admin/ConfirmSystem') || request()->is('admin/ConfirmSystem/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-exclamation-triangle nav-icon">

                                    </i>
                                    Syst. Potwierdzeń
                                </a>
                            </li>
            @endcan
            <!-- Zadania -->
            @can('job_access')
                <li class="nav-item">
                    <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is('admin/tasks') || request()->is('admin/tasks/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-tasks nav-icon">
                        </i>
                        {{ trans('cruds.task.title') }}
                    </a>
                </li>
            @endcan  
            <!-- Inwentaryzacja -->
            @can('job_access')
                <li class="nav-item">
                    <a href="{{ route("admin.inventory.index") }}" class="nav-link {{ request()->is('admin/inventory') || request()->is('admin/inventory/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-hand-holding-usd nav-icon">
                        </i>
                        Sprzęt
                    </a>
                </li>
            @endcan  

                   <!-- Configuration -->
             @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-cog nav-icon">

                        </i>
                        Konfiguracja
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('mail_config_access')
                            <li class="nav-item">
                            <a href="{{ url('/configuration/mail') }}" class="nav-link {{ request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-envelope nav-icon">

                                    </i>
                                    Mail
                                </a>
                            </li>
                        @endcan                       
                    </ul>
                </li>
            @endcan
            <!-- @can('user_access')
                            <li class="nav-item">
                                <a href="{{ url('test') }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                  Test
                                </a>
                            </li>
                        @endcan -->
            <!-- <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li> -->
        </ul>

    </nav>
    <!-- <button class="sidebar-minimizer brand-minimizer" type="button"></button> -->
    <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
</div>