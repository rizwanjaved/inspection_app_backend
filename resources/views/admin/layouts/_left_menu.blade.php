<ul id="menu" class="page-sidebar-menu">

    <li {!! (Request::is('admin') ? 'class="active"' : '') !!}>
        <a href="{{ route('admin.dashboard') }}">
            <i class="livicon" data-name="dashboard" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Dashboard </span>
        </a>
    </li>


    <li {!! (Request::is('admin/log_viewers') || Request::is('admin/log_viewers/logs')  ? 'class="active"' : '') !!}>

        <a href="{{  URL::to('admin/log_viewers') }}">
            <i class="livicon" data-name="help" data-size="18" data-c="#1DA1F2" data-hc="#1DA1F2"
               data-loop="true"></i>
            Log Viewer
        </a>
    </li>
    <li {!! (Request::is('admin/activity_log') ? 'class="active"' : '') !!}>
        <a href="{{  URL::to('admin/activity_log') }}">
            <i class="livicon" data-name="eye-open" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            Activity Log
        </a>
    </li>
    <!-- my dropddowns -->
    <!-- categories -->

    <!--  -->
    <li {!! (Request::is('admin/cars') ||Request::is('admin/cars/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Cars</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/cars') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/cars') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Cars
                </a>
            </li>
            <li {!! (Request::is('admin/cars/create') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/cars/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Car
                </a>
            </li>
        </ul>
    </li>
    <!--  -->
     <!--  -->
    <li {!! (Request::is('admin/appointments') ||Request::is('admin/appointments/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Appointments</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/appointments') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/appointments') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Appointments
                </a>
            </li>
        </ul>
    </li>
    <!--  -->
     <li {!! (Request::is('admin/inspections') ||Request::is('admin/inspections/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Inspections</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/inspections') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/inspections') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Inspections
                </a>
            </li>
        </ul>
    </li>
    <!--  -->
     <li {!! (Request::is('admin/registrations') ||Request::is('admin/registrations/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Registrations</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/registrations') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/registrations') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Registrations
                </a>
            </li>
        </ul>
    </li>

    <!--  -->
     <li {!! (Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/user_profile') || Request::is('admin/users/*') || Request::is('admin/deleted_users') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Users</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/users') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/users') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Users
                </a>
            </li>
            <li {!! (Request::is('admin/users/create') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/users/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New User
                </a>
            </li>
            <li {!! ((Request::is('admin/users/*')) && !(Request::is('admin/users/create')) || Request::is('admin/user_profile') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::route('admin.users.show',Sentinel::getUser()->id) }}">
                    <i class="fa fa-angle-double-right"></i>
                    View Profile
                </a>
            </li>
            <li {!! (Request::is('admin/deleted_users') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/deleted_users') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Deleted Users
                </a>
            </li>
        </ul>
    </li>
    <!--  -->
    
    <!-- /my dropdowns -->
    <!-- Menus generated by CRUD generator -->
    @include('admin/layouts/menu')
</ul>