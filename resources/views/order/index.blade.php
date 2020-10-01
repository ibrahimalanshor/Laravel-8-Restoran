@extends('__layouts.app', ['url' => ['Order', 'Data Order']])

@section('title', 'Data Order')

@section('content')

	<div class="col">
		<x-card title="Data Order">
			<div class="table-responsive mb-3">
				@if(session('success'))
					<x-alert type="success" :message="session('success')" dismiss></x-alert>
				@endif
				
				<x-slot name="collapse">
					<h5>Filter Table</h5>
					<form class="input-group">
						<div class="w-25">
							<select name="code[]" class="custom-select form-control" data-placeholder="No Table" multiple>
								@foreach($tables as $table)
									<option value="{{ $table->id }}" {{ $code ? in_array($table->id, $code) ? 'selected' : '' : '' }}>Table {{ $table->no }}</option>
								@endforeach
							</select>
						</div>
						<div class="input-group-append">
							<button class="btn btn-primary btn-sm" type="submit">Filter</button>
						</div>
					</form>
				</x-slot>

				<x-slot name="toolbar">
					<button class="btn btn-sm btn-success" data-toggle="collapse" data-target="#collapse">Filter</button>
				</x-slot>

				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Code</th>
							<th>No Table</th>
							<th>Menu</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse($orders as $order)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $order->code }}</td>
								<td>{{ $order->table->no }}</td>
								<td>
									<ul class="list-unstyled mb-0">
										@foreach($order->menu as $menu)
											<li>{{ $menu->name }} <span class="badge badge-secondary ml-1">{{ $menu->pivot->qty }}</span></li>
										@endforeach
									</ul>
								</td>
								<td>
									<a href="{{ route('order.show', $order->code) }}" class="btn btn-xs btn-primary">Checkout</a>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="5" align="center">Empty</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			{{ $orders->links() }}
		</x-card>
	</div>

@endsection

@push('styles')

	<link rel="stylesheet" href="{{ asset('concept-master/vendor/select2/css/select2.css') }}">

@endpush

@push('scripts')

	<script src="{{ asset('concept-master/vendor/select2/js/select2.min.js') }}"></script>
	
	<script>
		$('select').select2({
			width: '100%',
			placeholder: function () {
				$(this).data('placeholder')
			}
		})
	</script>


@endpush