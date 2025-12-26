<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>

@php
    $student = auth()->user();
@endphp

<div class="dashBoradPageBody">
    <div class="ddashboardSidebarOverlay"></div>

    <!-- SIDEBAR -->
    <div class="dashboardSidebar">
        <div class="dashboardSidebarinner">
            <div class="dashboardSidebarWrapper">

                <div class="dashboardSidebarHeader">
                    <div class="dashboardSidebarHeaderinner">
                        <a href="{{ route('student.dashboard') }}">
                            <img src="{{ asset('images/logo.svg') }}" alt="Logo">
                        </a>
                    </div>
                </div>

                <div class="dashboardSidebarMenuArea scrollbar">

                    <div class="dashboardSidebarMenu">
                        <ul>
                            <li>
                                <a href="{{ route('student.dashboard') }}" class="active">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Plans and Payments
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Transactions
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- LOGOUT -->
                    <div class="menu-bottom-sec">
                        <ul>
                            <li>
                                <form method="POST" action="{{ route('student.logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 text-danger">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="dashboardPagesContent">

        <!-- MOBILE HEADER -->
        <div class="dashboardHomeHeader">
            <div class="dashboardHomeHeaderinner">
                <div class="left-part">
                    <img src="{{ asset('images/logo.svg') }}" alt="">
                </div>
                <div class="right-part">
                    <button class="sidebar-trigger">
                        <span class="nan-btn-icon"></span>
                        <span class="nan-btn-icon"></span>
                        <span class="nan-btn-icon"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- PAGE BODY -->
        <div class="dashboardPagesContentonner">
            <div class="dashboardpageContectBox">

                <div class="home-top-sec">
                    <h2>Home</h2>
                    <p>
                        Welcome,
                        <strong>
                            {{ $student->email ?? $student->mobile }}
                        </strong>
                    </p>
                </div>

                <div class="home-bottom-sec">

                    <div class="home-dtl-box">
                        <h3>{{ $student->email ?? 'Student' }}</h3>
                        <p>You are almost there! Complete your setup.</p>
                        <button class="otp-btn">Add parent information</button>
                    </div>

                    <div class="home-dtl-box">
                        <h4>Setup a new payment plan</h4>
                        <p>Pay in instalments or in full</p>
                        <button class="register-btn">Register Student</button>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
