@extends('__layouts.admin', ['url' => ['admin', 'table']])

@section('title', 'Data Tables')

@section('content')

	<div class="col-lg-4">
		<x-card title="Add Table">
			<form action="{{ route('admin.table.store') }}" method="post" id="create">
				@csrf
				<div class="form-group">
					<label>No</label>
					<input type="number" class="form-control" placeholder="No" name="no" required autofocus value="{{ old('no') }}">

					<span class="invalid-feedback"></span>
				</div>
				<button class="btn btn-primary btn-block" type="submit">Add</button>
			</form>
		</x-card>
	</div>

	<div class="col-lg-8">
		<x-card title="Data Table">
			<div id="alert"></div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>No Table</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</x-card>
	</div>

@endsection

@push('styles')

	<link rel="stylesheet" type="text/css" href="{{ asset('concept-master/vendor/datatables-bs4/css/dataTables.bootstrap4.css') }}">

@endpush

@push('scripts')

    <script src="{{ asset('concept-master/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('concept-master/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

	<script>
		let ajax_url = "{{ route('admin.table.index') }}"
		let destroy_url = "{{ route('admin.table.destroy', ':id') }}"
    	let alert = '<x-alert message=":msg" type="success" dismiss />'
	</script>
	
    <script src="{{ asset('js/table.js') }}"></script>

@endpush