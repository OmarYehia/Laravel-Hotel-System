@extends('layout.main')

@section('title', 'Hotel Transylvania')

@section('content-title', 'Capacity')

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