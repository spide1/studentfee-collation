@extends('institute.layout')

@section('content')
<div class="container mt-4">
    <h3>Institute Profile</h3>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Name:</strong> {{ auth('institute')->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth('institute')->user()->email }}</p>
            <p><strong>Status:</strong>
                @if(auth('institute')->user()->is_active === 'Y')
                    <span class="badge bg-success">Approved</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
