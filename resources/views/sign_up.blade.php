@extends('layout.app')
@section('title', 'Sign in')
@section('content')

    <header class="d-flex justify-content-between px-5 pt-3">
        <span>Toolyt</span>
        <a href="/sign-in"><button class="btn btn-light btn-sm">Sign in</button></a>
    </header>
    <div id="signup"
        class="m-auto d-flex flex-column justify-content-center align-items-center h-100"
        style="width: max-content">
        <h5 class="fw-bolder pb-3">Create New Account</h5>
        @if ($errors->any())
            <div class="alert alert-danger w-100">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/sign-up" method="post">
            @csrf
            <div class="input-group mb-3 gap-4">
                <div>
                    <label for="fname">Firstname <span class="text-danger">*</span></label>
                    <input type="text" id="fname" name="firstname" class="form-control"
                        placeholder="Enter your firstname">
                </div>
                <div>
                    <label for="lname">Lastname <span class="text-danger">*</span></label>
                    <input type="text" id="lname" name="lastname" class="form-control"
                        placeholder="Enter your lastname">
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="w-100">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter yor email address"
                        id="email">
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="w-100">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password"
                        id="password">
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="w-100">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Re-Enter your password" id="password">
                </div>
            </div>
            <button style="background: rgb(57, 194, 57)" class="btn w-100 text-white">Create Account</button>
        </form>

    </div>
@endsection