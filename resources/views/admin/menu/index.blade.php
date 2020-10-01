@extends('__layouts.admin', ['url' => ['admin', 'menu']])

@section('title', 'Data Menu')

@section('content')

	<div class="col">
		<x-card title="Data Menu">
			<x-slot name="toolbar">
				<a href="{{ route('admin.menu.create') }}" class="btn btn-primary btn-sm">New Menu</a>
			</x-slot>
			@if(session('success'))
				<x-alert :message="session('success')" type="success" dismiss />
			@endif
			<div id="alert"></div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Actions</th>
						</tr>
					</thead>
				</table>
			</div>
		</x-card>
	</div>

	<div class="modal">
	<div class="modal-dialog">
	<div class="modal-content">
	<form action="" method="post" enctype="multipart/form-data">
		<div class="modal-header">
			<h5 class="modal-title">Edit Menu</h5>
			<button class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			@csrf
			@method('_put')
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" placeholder="Name" required autofocus>

				<span class="invalid-feedback"></span>
			</div>
			<div class="form-group">
				<label>Categories</label>
				<select id="categories" class="form-control @error('categories') is-invalid @enderror" name="categories[]" placeholder="Categories" multiple required></select>

				@error('categories')
					<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
			<div class="form-group">
				<label>Price</label>
				<input id="price" type="text" class="form-control" name="price" placeholder="Price" required>
				
				<span class="invalid-feedback"></span>
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea class="form-control" name="description" placeholder="Description" required></textarea>
				<span 
				class="invalid-feedback"></span>
			</div>
			<div class="form-group">
				<label>Photo</label>
				<div class="custom-file">
					<label class="custom-file-label" id="photo">Upload</label>
					<input type="file" class="form-control custom-file-input" name="file" placeholder="Photo">
					
					<span class="invalid-feedback"></span>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" type="submit">Update</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancel</button>
		</div>
	</form>
	</div>
	</div>
	</div>

@endsection

@push('styles')

	<link rel="stylesheet" type="text/css" href="{{ asset('concept-master/vendor/datatables-bs4/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('concept-master/vendor/inputmask/css/inputmask.css') }}">
	<link rel="stylesheet" href="{{ asset('concept-master/vendor/select2/css/select2.css') }}">
	<link rel="stylesheet" href="{{ asset('concept-master/vendor/select2/css/select2.css') }}">

@endpush

@push('scripts')

    <script src="{{ asset('concept-master/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('concept-master/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('concept-master/vendor/inputmask/js/jquery.inputmask.bundle.js') }}"></script>
	<script src="{{ asset('concept-master/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}"></script>
	<script src="{{ asset('concept-master/vendor/select2/js/select2.min.js') }}"></script>

	<script>
		let ajax_url = "{{ route('admin.menu.index') }}"
		let update_url = "{{ route('admin.menu.update', ':id') }}"
		let destroy_url = "{{ route('admin.menu.destroy', ':id') }}"
		let get_category_url = "{{ route('admin.category.get') }}"
    	let alert = '<x-alert message=":msg" type="success" dismiss />'
	</script>
	
    <script src="{{ asset('js/menu.js') }}"></script>

@endpush