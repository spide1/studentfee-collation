<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Institute Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<div class="dashBoradPageBody">

    <!-- SIDEBAR -->
    <div class="dashboardSidebar">
        <div class="dashboardSidebarinner">
            <div class="dashboardSidebarHeader">
                <img src="{{ asset('images/logo.svg') }}" width="140">
            </div>

            <div class="dashboardSidebarMenu">
                @include('institute.partials.sidebar')
            </div>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="dashboardPagesContent">

        <!-- 🔹 TOP BAR START -->
        <div class="dashboardTopBar">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center dashboardTopBarinner">

                    <!-- Left -->
                    <div class="leftPart">
                        {{-- <button class="sidebar-trigger toggle-tooltips">
                            <span class="nan-btn-icon"></span>
                            <span class="nan-btn-icon"></span>
                            <span class="nan-btn-icon"></span>
                        </button> --}}

                        <a href="#" class="search-icon">
                            <i class="fa-regular fa-magnifying-glass"></i>
                        </a>

                        <div class="top-search-box">
                            <i class="fa-regular fa-magnifying-glass"></i>
                            <input type="text" placeholder="Search here....">
                        </div>
                    </div>

                    <!-- Right -->
                    <div class="rightPart">
                        <div class="dropdown userDropdown">
                            <button class="btn dropdown-toggle dropdown-menu-trigger" data-bs-toggle="dropdown">
                                <span class="userttl">Company</span>
                                <span class="bedge">C</span>
                            </button>

                            <div class="dropdown-menu userDropdownMenu">
                                <div class="userDropdownMenuTop">
                                    <h5 class="userName">Company</h5>
                                    <p class="mb-0">company@example.com</p>
                                </div>

                                {{-- <ul class="userDropdownMenuList">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            <span class="icon">
                                                <i class="fa-regular fa-user"></i>
                                            </span>
                                            <span class="txt">Profile</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <span class="icon">
                                                <i class="fa-regular fa-right-from-bracket"></i>
                                            </span>
                                            <span class="txt">Log out</span>
                                        </a>
                                    </li>
                                </ul> --}}
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- 🔹 TOP BAR END -->

        <!-- PAGE CONTENT -->
        <div class="dashboardContentInner">
            @yield('content')
        </div>

    </div>
</div>



<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

@stack('scripts')

</body>
</html>


