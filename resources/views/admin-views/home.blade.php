@extends('layout.main')

@section('title', 'Hotel Transylvania')

@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item active">Home</li>
</ol>
@endsection

@section('content')
@if(Auth::guard('user')->user()->banned_at)
    <h1>YOU ARE BANNED, PLEASE CONTACT ADMIN</h1>
    @endsection
@else
    <div class="text-center">
        <h1><b>Welcome to your Administration panel</b></h1>
    </div>
    @endsection
@endif