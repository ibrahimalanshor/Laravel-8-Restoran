@extends('__layouts.auth')

@section('title', 'Admin Login')

@section('content')
<div class="card ">
    <div class="card-header text-center"><a href="{{ route('home') }}"><h2 class="mb-0">Admin Login</h2></a></div>
    <div class="card-body">
        <form action="{{ route('admin.login') }}" method="post">
            @csrf

            <div class="form-group">
                <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" type="password" placeholder="Password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><span class="custom-control-label">Remember Me</span>
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
        </form>
    </div>
</div>
@endsection
