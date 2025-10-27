@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}! You have admin access.</p>
    </div>
@endsection