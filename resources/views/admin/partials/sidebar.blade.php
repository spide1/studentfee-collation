<ul>
    <li>
        <a href="{{ route('admin.dashboard') }}" class="active">
            <i class="fa fa-home"></i> Dashboard
        </a>
    </li>

    <li>
        {{-- <a href="{{ route('admin.institutes') }}">
            <i class="fa fa-building"></i> Institutes
        </a> --}}
    </li>

    <li>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-link text-danger p-0">
                <i class="fa fa-sign-out"></i> Logout
            </button>
        </form>
    </li>
</ul>
