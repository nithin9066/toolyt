@extends('layout.app')
@section('title', 'Sign in')
@section('content')
    
<header class="d-flex justify-content-between px-5 pt-3">
    <span>Toolyt</span>
    <a href="/sign-up"><button class="btn btn-light btn-sm">Sign up</button></a>
</header>
@include('includes.login')
@endsection
