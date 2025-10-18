<aside class="left-sidebar primary-bg-new" style="">
    <div class="h-100">
        <div class="d-flex justify-content-center align-items-center mt-3 flex-column">
            <img src="{{ asset('assets/images/logo.jpg') }}" style="width: 80px; height: 80px" class="rounded-circle"
                alt="">
            <p class="mb-0 text-white my-2" style="font-weight: bold; font-size: 18px">MENRO-BAARS PORTAL</p>
        </div>
        <nav class="sidebar-nav scroll-sidebar position-relative pb-3" style="">
            <ul id="sidebarnav">
                <li class="nav-small-cap mt-1">
                    <i class="ti ti-dots nav-small-cap-icon text-white fs-4"></i>
                    <span class="hide-menu text-white">Main</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="bi bi-microsoft text-white"></i>
                        </span>
                        <span class="hide-menu text-white">Dashboard</span>
                    </a>
                </li>

                <li class="nav-small-cap mt-2">
                    <i class="ti ti-dots nav-small-cap-icon text-white fs-4"></i>
                    <span class="hide-menu text-white">Certification</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('association_view') }}" aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Association.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Association</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('boating_view') }}" aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Boating.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Boating</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('chainsaw_view') }}" aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Chainsaw.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Chainsaw</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('trees_view') }}" aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Cutting Trees.png') }}"
                            style="width: 20px; height: 30px" alt="">
                        <span class="hide-menu text-white">Cutting Trees</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('store_view') }}" aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Sari-Sari Store.png') }}"
                            style="width: 20px; height: 30px" alt="">
                        <span class="hide-menu text-white">Sari-Sari Store</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('tricycle_view') }}" aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Tricycle.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Tricycle</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('vendor_view') }}" aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Vendors.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Vendors</span>
                    </a>
                </li>
                <li class="nav-small-cap  mt-2">
                    <i class="ti ti-dots nav-small-cap-icon text-white fs-4"></i>
                    <span class="hide-menu text-white">Waste</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('wastecollect_view') }}" aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Waste Collection.png') }}"
                            style="width: 20px; height: 30px" alt="">
                        <span class="hide-menu text-white">Waste Collection</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('wastebottle_view') }}" aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Waste Bottle.png') }}"
                            style="width: 20px; height: 30px" alt="">
                        <span class="hide-menu text-white">Waste in the Bottle</span>
                    </a>
                </li>
                <li class="nav-small-cap mt-2">
                    <i class="ti ti-dots nav-small-cap-icon text-white fs-4"></i>
                    <span class="hide-menu text-white">Others</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('reportdashboard') }}" aria-expanded="false">
                        <span>
                            <i class="bi bi-journal-text text-white"></i>
                        </span>
                        <span class="hide-menu text-white">Report</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('profile_view') }}" aria-expanded="false">
                        <span>
                            <i class="bi bi-person-circle text-white"></i>
                        </span>
                        <span class="hide-menu text-white">Profile</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
