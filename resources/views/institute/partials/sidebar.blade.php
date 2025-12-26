<ul>

    {{-- Dashboard --}}
    <li class="{{ request()->routeIs('institute.dashboard') ? 'active' : '' }}">
        <a href="{{ route('institute.dashboard') }}">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>
    </li>

    {{-- Profile --}}
    <li class="{{ request()->routeIs('institute.profile') ? 'active' : '' }}">
        <a href="{{ route('institute.profile') }}">
            <i class="fa-solid fa-user"></i>
            Profile
        </a>
    </li>

    {{-- Students --}}
    @php
        $studentActive = request()->routeIs('institute.students.*');
    @endphp

    <li class="submenu {{ $studentActive ? 'open active' : '' }}">
        <a href="javascript:void(0)">
            <i class="fa-solid fa-user-graduate"></i>
            Students
            <span class="arrow"></span>
        </a>

        <ul style="{{ $studentActive ? 'display:block;' : '' }}">
            <li class="{{ request()->routeIs('institute.students.create') ? 'active' : '' }}">
                <a href="{{ route('institute.students.create') }}">
                    Register Student
                </a>
            </li>

            <li class="{{ request()->routeIs('institute.students.index') ? 'active' : '' }}">
                <a href="{{ route('institute.students.index') }}">
                    Student List
                </a>
            </li>
        </ul>
    </li>

    {{-- Payments --}}
    <li class="submenu">
        <a href="javascript:void(0)">
            <i class="fa-solid fa-credit-card"></i>
            Payments
            <span class="arrow"></span>
        </a>

        <ul>
            {{-- <li>
                <a href="#">
                    Fee Plans
                </a>
            </li> --}}
            <li>
                <a href="{{ route('institute.transactions') }}">
                    Transactions
                </a>
            </li>

        </ul>
    </li>

    {{-- Settings --}}
    <li>
        <a href="{{ route('institute.profile') }}">
            <i class="fa-solid fa-gear"></i>
            Settings
        </a>
    </li>

    {{-- Logout --}}
    <li>
        <form method="POST" action="{{ route('institute.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </li>

</ul>

<script>
    document.querySelectorAll('.submenu > a').forEach(menu => {
        menu.addEventListener('click', function() {
            this.parentElement.classList.toggle('open');
        });
    });
</script>
