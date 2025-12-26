@extends('institute.layout')

@section('content')
<div class="container mt-4">
    <h2>Welcome {{ auth('institute')->user()->name }}</h2>

    <p class="text-muted">
        Institute Dashboard Overview
    </p>
</div>
@endsection
