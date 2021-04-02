@extends('layout.main')

@section('title', 'Hotel Transylvania')

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
    <h1><b>Should be replaced with my reservations</b></h1>
</div>
@endsection
@endif