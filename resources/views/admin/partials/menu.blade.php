<style>
nav .navbar-nav li a {
    background-color: white !important;
}

.active-link {
    background-color: #A1CAF1 !important;
    color: black !important;
    /* Inne style, które chcesz zastosować dla aktywnego linku */
}
</style>
<div class="sidebar ">
    <nav class="sidebar-nav">

        <ul class="nav">
            <!-- Zlecenia -->
            @can('job_access')
            <li class="nav-item">
                <a href="{{ route("admin.jobs.index") }}"
                    class="nav-link {{ request()->is('admin/jobs') || request()->is('admin/jobs/*') ? 'active-link' : '' }}">
                    <i class="fa-fw fas fa-window-restore nav-icon"></i>
                    </i>
                    {{ trans('cruds.job.title') }}
                </a>
            </li>
            @endcan
            @can('ConfirmSystem_Access')
            <!-- System Potwierdzeń -->
            <li class="nav-item">
                <a href="{{ route("admin.ConfirmSystem.index") }}"
                    class="nav-link {{ request()->is('admin/ConfirmSystem') || request()->is('admin/ConfirmSystem/*') ? 'active-link' : '' }}">
                    <i class="fa-fw fas fa-exclamation-triangle nav-icon">

                    </i>
                    Syst. Potwierdzeń
                </a>
            </li>
            @endcan
            <!-- Sprzęt zast. -->
            @can('equipment_access')
            <li class="nav-item">
                <a href="{{ route("admin.repequipment.index") }}"
                    class="nav-link {{ request()->is('admin/repequipment') || request()->is('admin/repequipment/*') ? 'active-link' : '' }}">
                    <i class="fa-fw fas fa-desktop nav-icon">

                    </i>
                    Sprzęt zast.
                </a>
            </li>
            @endcan
            <!-- Zadania -->
            @can('calendar')
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon">
                    </i>
                    {{ trans('cruds.task.title') }}
                </a>
                <ul class="nav-dropdown-items" style="padding-left: 10%;">
                    <li class="nav-item">
                        <a href="{{ route("admin.tasks.index") }}"
                            class="nav-link {{ request()->is('admin/tasks') || request()->is('admin/tasks/*') ? 'active-link' : '' }}">
                            <i class="fa-fw fas fa-tasks nav-icon">
                            </i>
                            <!-- {{ trans('cruds.task.title') }} --> Lista
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/calendar/' . Auth::id()) }}"
                            class="nav-link {{ request()->is('admin/calendar') || request()->is('admin/calendar/*') ? 'active-link' : '' }}">
                            <i class="fa-fw fas fa-calendar nav-icon">
                            </i>
                            Kalendarz
                        </a>
                    </li>
                </ul>
            </li>


            @endcan

            <!-- Ustawienia -->
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa fa-address-book nav-icon">

                    </i>
                    Ustawienia
                </a>
                <ul class="nav-dropdown-items">
                    @can('user_management_access')
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link  nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-users nav-icon">

                            </i>
                            {{ trans('cruds.userManagement.title') }}
                        </a>
                        <ul class="nav-dropdown-items" style="padding-left: 10%;">
                            @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}"
                                    class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active-link' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                            @endcan
                            @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}"
                                    class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active-link' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                            @endcan
                            @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}"
                                    class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active-link' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                            @endcan


                        </ul>
                    </li>
                    @endcan
                    @can('user_dictionaries_access')
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link  nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa fa-address-book nav-icon">

                            </i>
                            {{ trans('cruds.dictionaries.title') }}
                        </a>
                        <ul class="nav-dropdown-items" style="padding-left: 10%;">
                            @can('TaskType_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.tasktype.index") }}"
                                    class="nav-link {{ request()->is('admin/tasktype') || request()->is('admin/tasktype/*') ? 'active-link' : '' }}">
                                    <i class="fa-fw fas fa-tasks nav-icon">

                                    </i>
                                    {{ trans('cruds.category.fields.projects') }}
                                </a>
                            </li>
                            @endcan
                            @can('TypeTask_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.typetask.index") }}"
                                    class="nav-link {{ request()->is('admin/typetask') || request()->is('admin/typetask/*') ? 'active-link' : '' }}">
                                    <i class="fa-fw fas fa-book nav-icon">

                                    </i>
                                    {{ trans('cruds.typetask.title_plulars') }}
                                </a>
                            </li>
                            @endcan
                            @can('car_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.car.index") }}"
                                    class="nav-link {{ request()->is('admin/car') || request()->is('admin/car/*') ? 'active-link' : '' }}">
                                    <i class="fa-fw fas fa-car nav-icon">

                                    </i>
                                    {{ trans('cruds.cars.title') }}
                                </a>
                            </li>
                            @endcan
                            @can('town_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.miasta.index") }}"
                                    class="nav-link {{ request()->is('admin/miasta') || request()->is('admin/miasta/*') ? 'active-link' : '' }}">
                                    <i class="fa-fw fas fa-city nav-icon">
                                    </i>
                                    {{ trans('cruds.miasta.title_singular') }}

                                </a>
                            </li>
                            @endcan
                        </ul>
                        @can('user_management_access')
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-cog nav-icon">

                            </i>
                            Konfiguracja
                        </a>
                        <ul class="nav-dropdown-items" style="padding-left: 10%;">
                            @can('mail_config_access')
                            <li class="nav-item">
                                <a href="{{ url('/configuration/mail') }}"
                                    class="nav-link   {{ request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active-link' : '' }}">
                                    <i class="fa-fw fas fa-envelope nav-icon">

                                    </i>
                                    Mail
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
            </li>
            @endcan
        </ul>
        </li>
        <!-- COMPANY -->
        @can('company_access')
        <li class="nav-item">
            <a href="{{ route("admin.companies.index") }}"
                class="nav-link {{ request()->is('admin/companies') || request()->is('admin/companies/*') ? 'active-link' : '' }}">
                <i class="fa-fw fas fa-handshake nav-icon">

                </i>
                {{ trans('cruds.company.title') }}
            </a>
        </li>
        @endcan
        @can('job_create')
        <li class="nav-item">
            <a class="nav-link" style="text-decoration: none;
        background-color: transparent !important;">
            </a>
        </li>
        @endcan
        @can('job_create')
        <li class="nav-item">
            <a class="nav-link" style="text-decoration: none;
        background-color: transparent !important;">
            </a>
        </li>
        @endcan

        <!-- Dodaj zlecenie -->

        @can('job_create')
        <li class="nav-item">
            <a class="nav-link  " href="{{ route('admin.jobs.create') }}">
                <i class="fa-fw fas fa-clipboard nav-icon"></i>
                </i>
                {{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}
            </a>
        </li>
        @endcan



        @can('job_create')
        <li class="nav-item">
            <a class="nav-link" href="#exampleModal" data-toggle="modal">
                <i class="fa-fw fas fa-desktop nav-icon">
                </i>
                Wyp. sprzęt zast.
            </a>
        </li>
        @endcan

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




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Wypożyczenie sprzętu zastępczego</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url("/wyp_sprz") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Sprzęt*</label>
                        <select name="fk_rep_eq" id="fk_rep_eq" class="form-control select2" required>
                            <option value=""></option>
                            @foreach($RepEquipment1 as $repEquipments)
                            <option value="{{ $repEquipments->id }}">{{ $repEquipments -> eq_number }}
                                {{ $repEquipments -> eq_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Klient*</label>
                        <select name="fk_company" id="fk_company" class="form-control select2" required>
                            <option value=""></option>
                            @foreach($companies as $company)
                            <option value="{{ $company->kontrahent_id }}">{{ $company -> kontrahent_kod }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.job.fields.description') }}</label>
                        <textarea class="form-control" name="description" id="comments" rows="3" required></textarea>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                    <button type="submit" class="btn btn-primary">Zapisz</button>
                </form>
            </div>
        </div>
    </div>
</div>