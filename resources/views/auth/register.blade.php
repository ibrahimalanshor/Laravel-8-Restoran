@extends('__layouts.auth')

@section('title', 'Register')

@section('content')

<div class="card ">
   <div class="card-header">
        <h3 class="mb-1">Registrations Form</h3>
        <p>Please enter your user information.</p>
    </div>
    <div class="card-body">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" placeholder="Name" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input placeholder="Email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input placeholder="Confirm Password" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button class="btn btn-block btn-primary" type="submit">Register</button>
        </form>
    </div>
    <div class="card-footer bg-white">
        <p>Already member? <a href="{{ route('login') }}" class="text-secondary">Login Here.</a></p>
    </div>
</div>

@endsection
