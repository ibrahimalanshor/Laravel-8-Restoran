@extends('__layouts.app', ['url' => ['User', $user->name]])

@section('title', $user->name)

@section('content')

	<div class="col-sm-6 mx-auto">
		<x-card title="Update Account">
			@if(session('success'))
				<x-alert type="success" :message="session('success')" dismiss></x-alert>
			@endif
			<form action="{{ route('user.update') }}" method="post">
				@csrf
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ $user->name }}" autofocus required>

					@error('name')
				  		<span class="invalid-feedback">{{ $message }}</span>
				  	@enderror
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ $user->email }}" required>

					@error('email')
				  		<span class="invalid-feedback">{{ $message }}</span>
				  	@enderror
				</div>
				<button class="btn btn-primary mt-2" type="submit">Update</button>
			</form>
		</x-card>
	</div>

@endsection