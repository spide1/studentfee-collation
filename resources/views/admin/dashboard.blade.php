@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="dashboardpageContectBox">

    <h3>Institute Approval Panel</h3>

    <table class="table table-bordered bg-white mt-3">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th width="200">Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($institutes as $inst)
            <tr>
                <td>{{ $inst->name }}</td>
                <td>{{ $inst->email }}</td>
                <td>
                    @if($inst->is_active === 'Y')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.institute.toggle', $inst->id) }}">
                        @csrf
                        <button class="btn btn-sm
                            {{ $inst->is_active === 'Y' ? 'btn-danger' : 'btn-success' }}">
                            {{ $inst->is_active === 'Y' ? 'Unapprove' : 'Approve' }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection
