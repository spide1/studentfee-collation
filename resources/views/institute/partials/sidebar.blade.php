<ul class="sidebar-menu">

    {{-- Dashboard --}}
    <li class="{{ request()->routeIs('institute.dashboard') ? 'active' : '' }}">
        <a href="{{ route('institute.dashboard') }}">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-layout-grid">
                    <rect width="7" height="7" x="3" y="3" rx="1" />
                    <rect width="7" height="7" x="14" y="3" rx="1" />
                    <rect width="7" height="7" x="14" y="14" rx="1" />
                    <rect width="7" height="7" x="3" y="14" rx="1" />
                </svg>
            </span>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- Profile --}}
    <li class="{{ request()->routeIs('institute.profile') ? 'active' : '' }}">
        <a href="{{ route('institute.profile') }}">
            <span class="icon"><i class="fa-solid fa-user"></i></span>
            <span>Profile</span>
        </a>
    </li>

    {{-- Students --}}
    @php $studentActive = request()->routeIs('institute.students.*'); @endphp

    <li class="submenu {{ $studentActive ? 'open active' : '' }}">
        <a href="#" class="submenu-toggle">
            <span class="icon"> <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="512" height="512" x="0" y="0" viewBox="0 0 32 32"
                        style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                        <g>
                            <path
                                d="M29.299 22.706v-8.305l.237-.138c.503-.292.803-.813.803-1.394s-.3-1.103-.803-1.395L17.379 4.412a3.306 3.306 0 0 0-3.319 0L1.902 11.475c-.502.292-.802.813-.802 1.394s.3 1.102.802 1.395l3.686 2.142v4.979a3.25 3.25 0 0 0 1.622 2.808l5.074 2.925c1.059.61 2.247.916 3.435.916s2.375-.305 3.435-.916l5.073-2.925a3.248 3.248 0 0 0 1.623-2.808v-4.98l1.649-.958v7.259a1.601 1.601 0 1 0 1.8 0zm-5.248-1.322h-.001c0 .514-.275.992-.721 1.248l-5.073 2.925a5.097 5.097 0 0 1-5.072 0L8.11 22.632a1.443 1.443 0 0 1-.721-1.248v-3.933l6.671 3.876a3.308 3.308 0 0 0 3.32 0l6.671-3.876zm-7.576-1.613a1.506 1.506 0 0 1-1.511 0L3.085 12.869l11.878-6.902a1.506 1.506 0 0 1 1.511 0l11.879 6.901z"
                                fill="#000000" opacity="1" data-original="#000000" class=""></path>
                        </g>
                    </svg></span>
                <span>Students</span>
                <span class="arrow">›</span>
        </a>

        <ul>
            <li class="{{ request()->routeIs('institute.students.create') ? 'active' : '' }}">
                <a href="{{ route('institute.students.create') }}">Register Student</a>
            </li>
            <li class="{{ request()->routeIs('institute.students.index') ? 'active' : '' }}">
                <a href="{{ route('institute.students.index') }}">Student List</a>
            </li>
        </ul>
    </li>

    {{-- Payments --}}
    <li class="submenu {{ request()->routeIs('institute.transactions') ? 'open active' : '' }}">
        <a href="#" class="submenu-toggle">
            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path
                            d="M496 319.996c-8.832 0-16 7.168-16 16v112H32v-192h176c8.832 0 16-7.168 16-16s-7.168-16-16-16H32v-64h176c8.832 0 16-7.168 16-16s-7.168-16-16-16H32c-17.664 0-32 14.336-32 32v288c0 17.664 14.336 32 32 32h448c17.664 0 32-14.336 32-32v-112c0-8.832-7.168-16-16-16z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                        <path
                            d="M144 319.996H80c-8.832 0-16 7.168-16 16s7.168 16 16 16h64c8.832 0 16-7.168 16-16s-7.168-16-16-16zM502.304 81.276l-112-48a16.337 16.337 0 0 0-12.64 0l-112 48A16.039 16.039 0 0 0 256 95.996v64c0 88.032 32.544 139.488 120.032 189.888 2.464 1.408 5.216 2.112 7.968 2.112s5.504-.704 7.968-2.112C479.456 299.612 512 248.156 512 159.996v-64c0-6.4-3.808-12.192-9.696-14.72zM480 159.996c0 73.888-24.448 114.56-96 157.44-71.552-42.976-96-83.648-96-157.44v-53.44l96-41.152 96 41.152v53.44z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                        <path
                            d="M442.016 131.484c-6.88-5.44-16.928-4.384-22.496 2.496l-50.304 62.912-19.904-29.76c-4.96-7.36-14.912-9.312-22.176-4.448-7.328 4.896-9.344 14.848-4.448 22.176l32 48c2.848 4.256 7.52 6.88 12.64 7.136H368c4.832 0 9.44-2.176 12.512-6.016l64-80c5.504-6.912 4.416-16.96-2.496-22.496z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                    </g>
                </svg></span>
            <span>Payments</span>
            <span class="arrow">›</span>
        </a>

        <ul>
            <li class="{{ request()->routeIs('institute.transactions') ? 'active' : '' }}">
                <a href="{{ route('institute.transactions') }}">Transactions</a>
            </li>
        </ul>
    </li>

    {{-- Subscriptions --}}
    <li class="{{ request()->routeIs('institute.subscriptions') ? 'active' : '' }}">
        <a href="{{ route('institute.subscriptions') }}">
            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
                    viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                    <g>
                        <path fill="#eceff1"
                            d="M12.75 18c0-2.278 1.468-4.203 3.5-4.927V4.75a2 2 0 0 0-2-2H2.75a2 2 0 0 0-2 2v13.5a2 2 0 0 0 2 2h10.526A5.201 5.201 0 0 1 12.75 18z"
                            opacity="1" data-original="#eceff1" class=""></path>
                        <path
                            d="M18 24c-3.309 0-6-2.691-6-6a.75.75 0 0 1 1.5 0c0 2.481 2.019 4.5 4.5 4.5s4.5-2.019 4.5-4.5-2.019-4.5-4.5-4.5c-1.489 0-2.778.684-3.632 1.925a.75.75 0 1 1-1.236-.85C14.257 12.938 16.031 12 18 12c3.309 0 6 2.691 6 6s-2.691 6-6 6z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                        <path
                            d="M15.945 15.75H13.75A.75.75 0 0 1 13 15v-2.25a.75.75 0 0 1 1.5 0v1.5h1.445a.75.75 0 0 1 0 1.5z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                        <path
                            d="M10.06 21H2.75A2.752 2.752 0 0 1 0 18.25V4.75A2.752 2.752 0 0 1 2.75 2h11.5A2.752 2.752 0 0 1 17 4.75v5.2a.75.75 0 0 1-1.5 0v-5.2c0-.689-.561-1.25-1.25-1.25H2.75c-.689 0-1.25.561-1.25 1.25v13.5c0 .689.561 1.25 1.25 1.25h7.31a.75.75 0 0 1 0 1.5z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                        <path
                            d="M3.75 5A.75.75 0 0 1 3 4.25V.75a.75.75 0 0 1 1.5 0v3.5a.75.75 0 0 1-.75.75zM8.5 5a.75.75 0 0 1-.75-.75V.75a.75.75 0 0 1 1.5 0v3.5A.75.75 0 0 1 8.5 5zM13.25 5a.75.75 0 0 1-.75-.75V.75a.75.75 0 0 1 1.5 0v3.5a.75.75 0 0 1-.75.75zM11.25 13.5h-7.5a.75.75 0 0 1 0-1.5h7.5a.75.75 0 0 1 0 1.5zM8.25 9.5h-4.5a.75.75 0 0 1 0-1.5h4.5a.75.75 0 0 1 0 1.5z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                    </g>
                </svg></span>
            <span>Subscriptions</span>
        </a>
    </li>

    {{-- Cashflow --}}
    <li class="{{ request()->routeIs('institute.cashflow') ? 'active' : '' }}">
        <a href="{{ route('institute.cashflow') }}">
            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
                    viewBox="0 0 510.383 510.383" style="enable-background:new 0 0 512 512" xml:space="preserve"
                    class="">
                    <g>
                        <path
                            d="m116.717 437.637-8.155-57.625c-1.161-8.202-8.759-13.927-16.953-12.75-8.203 1.16-13.911 8.751-12.75 16.953l1.826 12.905a225.536 225.536 0 0 1-36.563-64.5C-16.684 166.371 130.164-1.298 301.375 35.224c8.1 1.724 16.07-3.438 17.8-11.54 1.729-8.102-3.438-16.071-11.54-17.8C114.303-35.364-53.388 153.359 15.948 342.926a255.575 255.575 0 0 0 41.338 72.975l-14.494-2.784c-8.138-1.561-15.998 3.765-17.561 11.9-1.563 8.136 3.765 15.998 11.9 17.561l60.624 11.646c10.918 3.081 20.41-6.373 18.962-16.587zM494.757 167.618a255.575 255.575 0 0 0-41.338-72.975l14.495 2.784c8.131 1.56 15.998-3.765 17.561-11.9 1.563-8.136-3.765-15.998-11.9-17.561l-60.636-11.649c-10.779-3.034-20.42 6.215-18.95 16.588l8.155 57.626c1.06 7.49 7.479 12.9 14.833 12.9 9.169 0 16.144-8.103 14.87-17.104l-1.826-12.905a225.544 225.544 0 0 1 36.563 64.499c42.585 116.433-17.31 245.865-133.515 288.525-39.755 14.595-82.543 17.661-123.738 8.872-8.099-1.728-16.071 3.438-17.8 11.54s3.438 16.071 11.54 17.8c46.737 9.972 95.264 6.496 140.336-10.05 132.036-48.47 199.727-194.723 151.35-326.99z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                        <path
                            d="M410.845 256.059c0-85.883-69.754-155.754-155.493-155.754S99.859 170.176 99.859 256.059s69.754 155.754 155.493 155.754 155.493-69.871 155.493-155.754zm-280.986 0c0-69.341 56.296-125.754 125.493-125.754s125.493 56.413 125.493 125.754-56.296 125.754-125.493 125.754S129.859 325.4 129.859 256.059z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                        <path
                            d="M270.352 340.313v-12.521c25.993 0 44.079-20.4 44.079-43.366 0-23.913-19.431-43.367-43.314-43.367h-31.529c-7.342 0-13.314-5.996-13.314-13.367 0-7.114 5.599-13.366 13.523-13.366h30.187c5.297.053 10.539 2.44 14.388 6.555 5.658 6.05 15.15 6.366 21.201.707 6.05-5.659 6.366-15.151.707-21.201-9.408-10.058-22.494-15.899-35.928-16.054v-12.527c0-8.284-6.716-15-15-15s-15 6.716-15 15v12.521c-25.993 0-44.079 20.4-44.079 43.366 0 23.913 19.431 43.367 43.314 43.367h31.529c7.342 0 13.314 5.996 13.314 13.367 0 7.421-5.989 13.367-13.312 13.367l-.212-.001h-32.938c-3.737-.038-7.712-1.393-11.198-3.815-6.804-4.728-16.151-3.045-20.878 3.757-4.728 6.803-3.046 16.149 3.757 20.878 10.27 7.138 19.829 9.181 30.702 9.181v12.521c0 8.284 6.716 15 15 15 8.285-.002 15.001-6.718 15.001-15.002z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                    </g>
                </svg></span>
            <span>Cashflow</span>
        </a>
    </li>

    {{-- Overdue --}}
    <li class="{{ request()->routeIs('institute.overdue') ? 'active' : '' }}">
        <a href="{{ route('institute.overdue') }}">
            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
                    class="">
                    <g>
                        <path
                            d="M185.2 412.8c7.8 7.8 20.5 7.8 28.4 0l42.4-42.4 42.4 42.4c7.8 7.8 20.5 7.8 28.4 0s7.8-20.5 0-28.4L284.4 342l42.4-42.4c7.7-8 7.5-20.7-.5-28.4-7.8-7.5-20.1-7.5-27.9 0L256 313.6l-42.4-42.4c-7.8-7.8-20.6-7.8-28.4 0s-7.8 20.6 0 28.4l42.4 42.4-42.4 42.5c-7.8 7.8-7.8 20.5 0 28.3z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                        <path
                            d="M445.4 54.4h-58.3V20.1C387.3 9 378.6-.2 367.5-.4c-11.1-.2-20.3 8.5-20.5 19.6V54.4H165.1V20.1C165.1 9 156.1 0 145 0s-20 9-20.1 20.1v34.3H66.6c-31.7 0-57.4 25.7-57.4 57.4v342.8c0 31.7 25.7 57.4 57.4 57.4h378.8c31.7 0 57.4-25.7 57.4-57.4V111.8c0-31.7-25.7-57.4-57.4-57.4zm17.3 400.2c0 9.6-7.8 17.3-17.3 17.3H66.6c-9.5 0-17.3-7.8-17.3-17.3V210.9h413.4zm0-283.8H49.3v-58.9c0-9.6 7.7-17.3 17.3-17.3h58.3v27.6c0 11.1 9 20.1 20.1 20.1s20-9 20.1-20.1V94.5H347v27.6c-.2 11.1 8.5 20.3 19.6 20.5s20.3-8.5 20.5-19.6V94.5h58.3c9.6 0 17.3 7.8 17.3 17.3z"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                    </g>
                </svg></span>
            <span>Overdue</span>
        </a>
    </li>

    {{-- Reports --}}
    <li class="{{ request()->routeIs('institute.reports') ? 'active' : '' }}">
        <a href="{{ route('institute.reports') }}">
            <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
                    viewBox="0 0 511 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
                    class="">
                    <g>
                        <path
                            d="M436.031 107.031 331.43 4.297A15 15 0 0 0 320.918 0H56.468C25.61 0 .5 25.105.5 55.969V456.03C.5 486.891 25.605 512 56.469 512H384.55c30.86 0 55.969-25.105 55.969-55.969V117.734a15 15 0 0 0-4.489-10.703zM335.918 50.758l52.922 51.976h-48.153a4.776 4.776 0 0 1-4.769-4.77zM384.551 482H56.469C42.152 482 30.5 470.352 30.5 456.031V55.97C30.5 41.649 42.148 30 56.469 30h249.453v67.965c0 19.172 15.598 34.77 34.77 34.77h69.828V456.03c0 14.32-11.649 25.969-25.97 25.969zm0 0"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                        <path
                            d="M324.645 238H113.19c-8.285 0-15 6.715-15 15s6.715 15 15 15h211.454c8.285 0 15-6.715 15-15s-6.715-15-15-15zM113.191 328h172.414c8.286 0 15-6.715 15-15s-6.714-15-15-15H113.191c-8.285 0-15 6.715-15 15s6.715 15 15 15zM306.406 358H113.191c-8.285 0-15 6.715-15 15s6.715 15 15 15h193.215c8.281 0 15-6.715 15-15s-6.719-15-15-15zm0 0"
                            fill="#000000" opacity="1" data-original="#000000" class="">
                        </path>
                    </g>
                </svg></span>
            <span>Reports</span>
        </a>
    </li>

    {{-- Logout --}}
    <li>
        <form method="POST" action="{{ route('institute.logout') }}">
            @csrf
            <button type="submit">
                <span class="icon"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-log-out mr-2 h-4 w-4">
                                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                            <polyline points="16 17 21 12 16 7"></polyline>
                                                            <line x1="21" x2="9" y1="12" y2="12"></line>
                                                        </svg></span>
                Logout
            </button>
        </form>
    </li>

</ul>
@push('styles')
    <style>
        .sidebar-menu li {
            list-style: none;
        }

        .sidebar-menu a,
        .sidebar-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            color: #374151;
            width: 100%;
            text-align: left;
            border: none;
            background: none;
        }

        .sidebar-menu li.active>a,
        .sidebar-menu li.active>button {
            background: #eef2ff;
            color: #3b82f6;
            font-weight: 600;
        }

        .icon {
            width: 20px;
            display: inline-flex;
        }

        .submenu ul {
            max-height: 0;
            overflow: hidden;
            transition: max-height .3s ease;
            margin-left: 15px;
        }

        .submenu.open ul {
            max-height: 300px;
        }

        .submenu .arrow {
            margin-left: auto;
            transition: transform .3s;
        }

        .submenu.open .arrow {
            transform: rotate(90deg);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.querySelectorAll('.submenu-toggle').forEach(t => {
            t.addEventListener('click', e => {
                e.preventDefault();
                const parent = t.closest('.submenu');
                parent.classList.toggle('open');
            });
        });
    </script>
@endpush
