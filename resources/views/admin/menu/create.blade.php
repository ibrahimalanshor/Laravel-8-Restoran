@extends('__layouts.admin', ['url' => ['admin', 'menu', 'create']])

@section('title', 'New Menu')

@section('content')

	<div class="col-lg-6 mx-auto">
		<x-card title="New Menu">
			<form action="{{ route('admin.menu.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>

					@error('name')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label>Price</label>
					<input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Price" value="{{ old('price') }}" required>

					@error('price')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label>Categories</label>
					<select id="categories" class="form-control @error('categories') is-invalid @enderror" name="categories[]" placeholder="Categories" multiple required></select>

					@error('categories')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" value="{{ old('description') }}" required></textarea>

					@error('description')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label>Photo</label>
					<div class="custom-file">
						<label class="custom-file-label">Upload</label>
						<input type="file" class="form-control custom-file-input @error('photo') is-invalid @enderror" name="file" placeholder="Photo" required>
						
						@error('photo')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
				</div>
				<button class="btn btn-primary mt-2" type="submit">Create</button>
				<a href="{{ route('admin.menu.index') }}" class="btn btn-danger mt-2">Cancel</a>
			</form>
		</x-card>
	</div>

@endsection

@push('styles')

	<link rel="stylesheet" href="{{ asset('concept-master/vendor/inputmask/css/inputmask.css') }}">
	<link rel="stylesheet" href="{{ asset('concept-master/vendor/select2/css/select2.css') }}">

@endpush

@push('scripts')

	<script src="{{ asset('concept-master/vendor/inputmask/js/jquery.inputmask.bundle.js') }}"></script>
	<script src="{{ asset('concept-master/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}"></script>
	<script src="{{ asset('concept-master/vendor/select2/js/select2.min.js') }}"></script>
	<script>
		bsCustomFileInput.init()
		$('#categories').select2({
			placeholder: 'Categories',
			ajax: {
				url: '{{ route("admin.category.get") }}',
				type: 'post',
				data: params => {
					return {
						'_token': $('[name=_token]').val(),
						'nama_kategori': params.term
					}
				},
				dataType: 'json',
				processResults: res => ({
					results: res
				}),
				cache: true
			}
		})
		$('#price').inputmask({
			alias: 'currency',
			prefix: ''
		})
	</script>
@endpush