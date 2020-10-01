@extends('__layouts.admin', ['url' => ['admin', 'user']])

@section('title', 'Data User')

@section('content')

	<div class="col">
		<x-card title="Data User">
			<div id="alert"></div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Email</th>
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
		let ajax_url = "{{ route('admin.user.index') }}"
		let destroy_url = "{{ route('admin.user.destroy', ':id') }}"
    	let alert = '<x-alert message=":msg" type="success" dismiss />'
	</script>
	
    <script src="{{ asset('js/user.js') }}"></script>

@endpush