<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>

<div class="dashBoradPageBody">

    <!-- SIDEBAR -->
    <div class="dashboardSidebar">
        <div class="dashboardSidebarinner">

            <div class="dashboardSidebarHeader">
                <img src="{{ asset('images/logo.svg') }}" width="140">
            </div>

            <!-- 🔥 ROLE BASED SIDEBAR -->
            <div class="dashboardSidebarMenu">
                @yield('sidebar')
            </div>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="dashboardPagesContent">
        @yield('content')
    </div>

</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
