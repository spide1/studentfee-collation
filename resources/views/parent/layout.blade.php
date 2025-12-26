<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parent Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
                @include('parent.partials.sidebar')
            </div>

        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="dashboardPagesContent">
        @yield('content')
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

@stack('scripts')
</body>
</html>
