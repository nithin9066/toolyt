@section('title', 'Sign in')
<div id="signin" class="m-auto d-flex flex-column justify-content-center align-items-center h-100"
    style="width: max-content">
    <h5 class="fw-bolder pb-3">Log in to Toolyt</h5>
    @if ($errors->any())
        <div class="alert alert-danger w-100">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/sign-in" method="post" class="w-100">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="email"><span class="iconify"
                    data-icon="ic:outline-email"></span></span>
            <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="password"><span class="iconify"
                    data-icon="mdi:password-outline"></span></span>
            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password"
                aria-describedby="password">
        </div>
        <button style="background: rgb(57, 194, 57)" class="btn w-100 text-white">Log in</button>
    </form>
    <span style="font-size: .8rem" class="mt-3 mb-2">Or log in with</span>
    <div class="d-flex justify-content-center w-100 gap-2">
        <a class="text-decoration-none w-100" href="/auth/google/login">
            <button class="btn btn-light w-100 d-flex justify-content-center align-items-center gap-2">
                <span class="iconify" data-icon="logos:google-icon"></span> Google
            </button>
        </a>
        <a class="text-decoration-none w-100" href="/auth/linkedin/login">
            <button class="btn btn-light w-100 d-flex justify-content-center align-items-center gap-2">
                <span class="iconify" data-icon="logos:linkedin-icon"></span> LinkedIn
            </button>
        </a>
    </div>
</div>
