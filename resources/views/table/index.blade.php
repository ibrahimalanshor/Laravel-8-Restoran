@extends('__layouts.app', ['url' => ['table', 'Data Table']])

@section('title', 'Data Table')

@section('content')

	<div class="col-md-8 col-lg-6 mx-auto">
		<x-card title="Data Table">
			<div class="row">
				@foreach($tables as $table)
					<div class="col-3 col-sm-2 col-md-3 col-xl-2 py-2">
						@if($table->order)
							@if($table->order->active)
								<a href="{{ route('order.show', $table->order->code) }}">
									<div class="table-box bg-success d-flex justify-content-center align-items-center text-white">
										{{ $table->no }}
									</div>
								</a>
							@else
								<div class="table-box bg-primary d-flex justify-content-center align-items-center text-white">
									{{ $table->no }}
								</div>
							@endif
						@else
							<div class="table-box bg-primary d-flex justify-content-center align-items-center text-white">
								{{ $table->no }}
							</div>
						@endif
					</div>
				@endforeach
			</div>

			<x-slot name="content">
				<h5>Note</h5>
				<span class="mr-2">
					<span class="badge-primary badge-dot"></span>
					Empty
				</span>
				<span class="mr-2">
					<span class="badge-success badge-dot"></span>
					Filled
				</span>
			</x-slot>

		</x-card>
	</div>

@endsection