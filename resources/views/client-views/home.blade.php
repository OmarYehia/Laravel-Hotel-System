@extends('layout.main')

@section('title', 'Hotel Transylvania')
@if(Auth::guard('client')->user()->approval_status==="pending" || Auth::guard('client')->user()->approval_status==="denied")

@section('content-title', 'My Reservations')
@section('content')

<h1>Your request is still pending, Stay tuned!</h1>

@endsection
@else

@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item active">Home</li>
</ol>
@endsection

@section('content')
@if(Auth::guard('client')->user()->approval_status=="pending" || Auth::guard('client')->user()->approval_status=="denied")
<div class="text-center">
    <h1><b>Your Request is pending approval, Stay tuned</b></h1>
</div>
@endsection
@else
<div class="text-center">
    <h1><b>Welcome to Hotel Transylvania</b></h1>
</div>
@endsection
@endif