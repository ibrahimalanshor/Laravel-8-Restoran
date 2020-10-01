@extends('__layouts.app', ['url' => ['order', 'checkout', $order->code]])

@section('title', 'Checkout')

@section('content')

	<div class="col-md-8 mx-auto">
		<x-card title="Checkout" small-title="title">
			<x-slot name="toolbar">
				<h3 class="mb-0">Invoice #{{ $order->id }}</h3>
				Date: {{ normalDate($order->created_at) }}
			</x-slot>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Menu</th>
							<th>Unit Cost</th>
							<th>Qty</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@php
							$total = collect()
						@endphp
						@foreach($order->menu as $menu)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $menu->name }}</td>
								<td>{{ $menu->price }}</td>
								<td>{{ $menu->pivot->qty }}</td>
								<td>{{ totalPrice($menu->price, $menu->pivot->qty) }}</td>
								@php $total->push(currencyToNumber(totalPrice($menu->price, $menu->pivot->qty))) @endphp
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="row">
                <div class="col-lg-7 col-sm-5">
                </div>
                <div class="col-lg-5 col-sm-5">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Total</strong>
                                </td>
                                <td class="right">
                                    <strong class="text-dark">{{ numberToCurrency($total->sum()) }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <x-slot name="footer">
            	<div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <p class="mb-0">{{ site('address') }} - {{ $order->user->name }}</p>
                    <div>
                    	<a class="btn btn-success btn-sm" href="{{ route('order.print', $order->id) }}">Print</a>
                    	@if($order->active)
                    		<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#payment">Submit Payment</button>
                    	@endif
                    </div>
                </div>
            </x-slot>
		</x-card>
	</div>

	<div class="modal" id="payment">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Submit Payment</h5>
			<button class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<label>Total Payment</label>
				<input type="text" class="form-control" placeholder="Total Payment" value="{{ numberToCurrency($total->sum()) }}" disabled>
			</div>
			<div class="form-group">
				<label>Money</label>
				<input type="number" class="form-control" name="money" placeholder="Money">
			</div>
			<div class="form-group">
				<label>Change</label>
				<input type="text" class="form-control" name="change" placeholder="Change" disabled>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary btn-sm submit" disabled>Submit</button>
			<button class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
		</div>
	</div>
	</div>
	</div>

@endsection

@push('scripts')
	
	<script>

		let total = parseInt('{{ $total->sum() }}')
		let change = $('[name=change]')
		let submit = $('.submit')
		let submitUrl = '{{ route("order.pay", $order->id) }}'

		submit.attr('disabled', 'disabled')
		
		$('[name=money]').on('keyup', function () {
			let money = this.value

			change.val(Math.max(0, money - total))

			money < total ? submit.attr('disabled', 'disabled') : submit.removeAttr('disabled')
		})

		submit.click(function () {
			window.location.href = submitUrl
		})

	</script>

@endpush