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
    <li {!! (Request::is('admin/category') || Request::is('admin/category/create') || Request::is('admin/category/*/edit')  ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Categories </span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/category') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/category') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Categories
                </a>
            </li>
             <li {!! (Request::is('admin/category/create') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/category/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Categories
                </a>
            </li>
        </ul>
    </li>
    <li {!! (Request::is('admin/region') || Request::is('admin/region/create') || Request::is('admin/region/*/edit')  ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Regions </span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/region') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/region') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Regions
                </a>
            </li>
             <li {!! (Request::is('admin/region/create') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/region/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Regions
                </a>
            </li>
        </ul>
    </li>
     <li {!! (Request::is('admin/channel') || Request::is('admin/channel/create') || Request::is('admin/channel/*')  || Request::is('admin/channel/*/edit') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Channels</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/channel') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/channel') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Channels
                </a>
            </li>
             <li {!! (Request::is('admin/channel/create') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/channel/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Channels
                </a>
            </li>
        </ul>
    </li>
    <li {!! (Request::is('admin/event') || Request::is('admin/event/create') || Request::is('admin/event/*') || Request::is('admin/event/*/edit')  ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Events</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/event') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/event') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Events
                </a>
            </li>
             <li {!! (Request::is('admin/event/create') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/event/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Events
                </a>
            </li>
        </ul>
    </li>
      <li {!! (Request::is('admin/vod') || Request::is('admin/vod/create') || Request::is('admin/vod/*') || Request::is('admin/vod/*/*') || Request::is('admin/vodc') || Request::is('admin/vodc/*/*') || Request::is('admin/vodc/*')  ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="medal" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">VODs</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/vodc') || Request::is('admin/vodc/*') || Request::is('admin/vodc/*/*') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/vodc') }}">
                    <i class="fa fa-angle-double-right"></i>
                    VOD Categories
                </a>
            </li>
            <li {!! (Request::is('admin/vod') || Request::is('admin/vod/*') || Request::is('admin/vod/*/*') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/vod') }}">
                    <i class="fa fa-angle-double-right"></i>
                    VODs
                </a>
            </li>
             <li {!! (Request::is('admin/vod/create') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/vod/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New VODs
                </a>
            </li>
        </ul>
    </li>
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
    
    <!-- /my dropdowns -->
    <!-- Menus generated by CRUD generator -->
    @include('admin/layouts/menu')
</ul>