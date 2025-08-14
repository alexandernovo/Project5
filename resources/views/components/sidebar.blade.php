<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img d-flex align-items-center gap-2 mt-4">
                <img src="{{ asset('assets/images/wvmc.png') }}" width="" alt=""
                    style="width: 40px; height: 40px" />
                <span style="font-size: 28px; letter-spacing: 4px; font-weight: 600; color:black"
                    class="text-dark title-sidebar">
                    DIRS
                </span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar mt-4 position-relative" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap mt-0">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap ">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">PAGES</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="" aria-expanded="false">
                        <span>
                            <i class="ti ti-alert-circle"></i>
                        </span>
                        <span class="hide-menu">Incident Reports</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ isset($activepage) && $activepage == 'messages' ? 'active' : '' }}"
                        href="" aria-expanded="false">
                        <span>
                            <i class="ti ti-message"></i>
                        </span>
                        <span class="hide-menu">Messages</span>
                    </a>
                </li>
                @if (session('user')->role == 'ADMIN')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
                            <span>
                                <i class="ti ti-user-plus"></i>
                            </span>
                            <span class="hide-menu">Admin</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
                            <span>
                                <i class="ti ti-user-plus"></i>
                            </span>
                            <span class="hide-menu">Supervisor</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
                            <span>
                                <i class="ti ti-cards"></i>
                            </span>
                            <span class="hide-menu">Nature Of Incident</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-description"></i>
                            </span>
                            <span class="hide-menu">Reports</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">SETTINGS</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="logout-style logout-btn cursor-pointer d-flex align-items-center gap-2"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-logout" style="font-size: 21px"></i>
                            </span>
                            <span class="hide-menu">Logout</span>
                        </a>
                    </li>
            </ul>
            {{-- <div class="mb-5 sidebar-config-dev">
                <div class="d-flex gap-2 position-relative flex-column justify-content-center align-items-center">
                    <div>
                        <img src="{{ asset('assets/images/backend.gif') }}" alt="" style="width: 100px"
                            class="img-fluid" loading="lazy">
                    </div>
                    <div class="unlimited-access-title">
                        <h6 class="fw-semibold fs-4 text-dark w-85 text-nowrap mb-1">
                        </h6>
                        <p class="mb-0 text-center">
                        </p>
                    </div>
                </div>
            </div> --}}
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
