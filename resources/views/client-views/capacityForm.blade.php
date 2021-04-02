@extends('layout.main')

@section('title', 'Hotel Transylvania')
@if(Auth::guard('client')->user()->approval_status==="pending" || Auth::guard('client')->user()->approval_status==="denied")

@section('content-title', 'My Reservations')
@section('content')

<h1>Your request is still pending, Stay tuned!</h1>

@endsection
@else

@section('content-title', 'How many persons are with you?')

@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active">Capacity Form</li>
</ol>
@endsection
@section('content')
<form action="{{ route ('ajaxavailablerooms.index') }}" method="GET">
@csrf
<input type="text" name="capacity" placeholder="Enter Capacity">
<input type="submit">
</form> 
@endsection
@endif