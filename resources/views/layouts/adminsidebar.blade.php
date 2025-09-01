<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="../index.html" class="brand-link">
            <!--begin::Brand Image-->
            {{-- <img src="../../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> --}}
            <span class="brand-text fw-light">ZKT</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-border"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- <li class="nav-item {{ request()->is('admin/role/permission/*') ? 'menu-open' : '' }}"> <a href="#" class="nav-link {{ request()->is('admin/role/permission/*') ? 'active' : '' }}">  <span class="nav-icon mdi mdi-home"></span>
                        <p>
                           Role & Permission
                            <i class="nav-arrow bi bi-chevron-right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('admin.roleIndex') }}" class="nav-link {{ request()->is('admin/role/permission/role/*') ? 'active' : '' }}"> <i
                                    class="mdi mdi-account-group"></i>
                                <p>Role List</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('admin.permissionIndex') }}" class="nav-link {{ request()->is('admin/role/permission/permission/*') ? 'active' : '' }}"> <i
                                    class="mdi mdi-axis-lock"></i>
                                <p>Permission List</p>
                            </a> </li>
                    </ul>
                </li>

                <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Forms
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="../forms/general.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>General Elements</p>
                            </a> </li>
                    </ul>
                </li> --}}


                <li class="nav-header">USER</li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.syncuser') }}" class="nav-link {{ request()->is('admin/employee/sync/*') ? 'active' : '' }}">
                         <i class="mdi mdi-account-group"></i>
                         <p>User</p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('admin.indexEmployee') }}" class="nav-link {{ request()->is('dmin/employee/list/*') ? 'active' : '' }}">
                         <i class="mdi mdi-account-group"></i>
                         <p>Employee List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.indexAttendence') }}" class="nav-link {{ request()->is('admin/list/attendence/*') ? 'active' : '' }}">
                         <i class="mdi mdi-fingerprint"></i>
                         <p>Attendence</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.leaveType.index') }}" class="nav-link {{ request()->is('admin/leave-type/*') ? 'active' : '' }}">
                         <i class="mdi mdi-beach"></i>
                         <p>Leave Types</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.leaveApply.index') }}" class="nav-link {{ request()->is('admin/leave-apply/*') ? 'active' : '' }}">
                         <i class="mdi mdi-umbrella-beach-outline"></i>
                         <p>Leave Apply</p>
                    </a>
                </li>


               <li class="nav-header">SETTINGS</li>

                <li class="nav-item">
                     <a href="{{ route('admin.settingCreate') }}" class="nav-link {{ request()->is('admin/setting/*') ? 'active' : '' }}"> <i
                            class="mdi mdi-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>


                {{-- <li class="nav-item">
                    <a href="{{ route('admin.connection') }}" class="nav-link {{ request()->is('aadmin/connection/*') ? 'active' : '' }}">
                         <i class="mdi mdi-connection"></i>
                         <p>Connection</p>
                    </a>
                </li> --}}

            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside>
