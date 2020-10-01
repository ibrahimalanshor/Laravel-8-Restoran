@extends('__layouts.admin', ['url' => ['admin', 'category']])

@section('title', 'Data Category')

@section('content')

	<div class="col-lg-4">
		<x-card title="Add Category">
			<form action="{{ route('admin.category.store') }}" method="post" id="create">
				@csrf
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" placeholder="Name" name="name" required autofocus value="{{ old('Name') }}">

					<span class="invalid-feedback"></span>
				</div>
				<button class="btn btn-primary btn-block" type="submit">Add</button>
			</form>
		</x-card>
	</div>

	<div class="col-lg-8">
		<x-card title="Data Category">
			<div id="alert"></div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Action</th>
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

@endpush

@push('scripts')

    <script src="{{ asset('concept-master/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('concept-master/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

	<script>
		let ajax_url = "{{ route('admin.category.index') }}"
		let destroy_url = "{{ route('admin.category.destroy', ':id') }}"
		let update_url = "{{ route('admin.category.update', ':id') }}"
    	let alert = '<x-alert message=":msg" type="success" dismiss />'
	</script>
	
    <script src="{{ asset('js/category.js') }}"></script>

@endpush