<aside class="left-sidebar primary-bg-new border-0" style="">
    <div class="h-100">
        <div class="d-flex justify-content-center align-items-center mt-3 flex-column">
            <img src="{{ asset('assets/images/logo.jpg') }}" style="width: 80px; height: 80px" class="rounded-circle"
                alt="">
            <p class="mb-0 text-white my-2" style="font-weight: bold; font-size: 17px">MENRO-BARS PORTAL</p>
        </div>
        <nav class="sidebar-nav scroll-sidebar position-relative pb-3" style="">
            <ul id="sidebarnav">
                <li class="sidebar-item mt-3">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('dashboard') }}"
                        aria-expanded="false">
                        <span>
                            <i class="bi bi-microsoft text-white"></i>
                        </span>
                        <span class="hide-menu text-white">Dashboard</span>
                    </a>
                </li>
                <hr class="mt-2 my-1 border-top border-secondary">
                <li class="nav-small-cap mt-0">
                    <i class="ti ti-dots nav-small-cap-icon text-white fs-4"></i>
                    <span class="hide-menu text-white" style="font-size: 14px">Certification</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('association_view') }}"
                        aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Association.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Association</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('boating_view') }}"
                        aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Boating.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Boating</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('chainsaw_view') }}"
                        aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Chainsaw.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Chainsaw</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('trees_view') }}"
                        aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Cutting Trees.png') }}"
                            style="width: 20px; height: 30px" alt="">
                        <span class="hide-menu text-white">Cutting Trees</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('store_view') }}"
                        aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Sari-Sari Store.png') }}"
                            style="width: 20px; height: 30px" alt="">
                        <span class="hide-menu text-white">Sari-Sari Store</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('tricycle_view') }}"
                        aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Tricycle.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Tricycle</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('vendor_view') }}"
                        aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Vendors.png') }}" style="width: 20px; height: 30px"
                            alt="">
                        <span class="hide-menu text-white">Vendors</span>
                    </a>
                </li>
                <hr class="mt-2 my-1 border-top border-secondary">
                <li class="nav-small-cap mt-0">
                    <i class="ti ti-dots nav-small-cap-icon text-white fs-4"></i>
                    <span class="hide-menu text-white" style="font-size: 14px">Waste</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('wastecollect_view') }}"
                        aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Waste Collection.png') }}"
                            style="width: 20px; height: 30px" alt="">
                        <span class="hide-menu text-white">Waste Collection</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('wastebottle_view') }}"
                        aria-expanded="false">
                        <img src="{{ asset('assets/images/icons/Waste Bottle.png') }}"
                            style="width: 20px; height: 30px" alt="">
                        <span class="hide-menu text-white">Waste in the Bottle</span>
                    </a>
                </li>
                <hr class="my-1 border-top border-secondary">
                <li class="sidebar-item">
                    <a class="sidebar-link py-1 cursor-pointer " style="font-size: 11px" data-bs-toggle="modal"
                        data-bs-target="#certificationModal" aria-expanded="false">
                        <span>
                            <i class="bi bi-journal-text text-white"></i>
                        </span>
                        <span class="hide-menu text-white">Certification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link py-1 cursor-pointer " style="font-size: 11px" data-bs-toggle="modal"
                        data-bs-target="#wasteModal" aria-expanded="false">
                        <span>
                            <i class="bi bi-journal-text text-white"></i>
                        </span>
                        <span class="hide-menu text-white">Waste</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('reportdashboard') }}"
                        aria-expanded="false">
                        <span>
                            <i class="bi bi-journal-text text-white"></i>
                        </span>
                        <span class="hide-menu text-white">Report</span>
                    </a>
                </li> --}}
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link py-1" style="font-size: 11px" href="{{ route('profile_view') }}"
                        aria-expanded="false">
                        <span>
                            <i class="bi bi-person-circle text-white"></i>
                        </span>
                        <span class="hide-menu text-white">Profile</span>
                    </a>
                </li> --}}
            </ul>
        </nav>
    </div>
</aside>
