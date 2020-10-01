@extends('__layouts.admin', ['url' => ['admin', 'setting']])

@section('title', 'Restaurant Setting')

@section('content')

	<div class="col-md-6 mx-auto">
		<x-card title="Restaurant Setting">
			@if(session('success'))
				<x-alert type="success" :message="session('success')" dismiss></x-alert>
			@endif
			<form action="{{ route('admin.setting.update') }}" method="post">
				@csrf
				@method('put')
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Name" value="{{ site('name') }}" name="name" autofocus required>

					@error('name')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" placeholder="Address" value="{{ site('address') }}" name="address" autofocus required>

					@error('address')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<button class="btn btn-primary btn-block" type="submit">Update</button>
			</form>
		</x-card>
	</div>

@endsection