<!DOCTYPE html>
<html lang="en">
<head>
	<title>Print</title>
	@include('__includes.head')
</head>

<body>
	<div class="bg-white">
	<div class="d-flex justify-content-between align-items-center" name="toolbar">
		{{ site('name') }}
		<div>
			<h3 class="mb-0">Invoice #{{ $order->id }}</h3>
			Date: {{ normalDate($order->created_at) }}
		</div>
	</div>

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
	    <div class="col-lg-5 col-sm-5 ml-auto">
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

	<div name="footer">
		<div class="d-flex justify-content-between align-items-center">
	        <p class="mb-0">{{ site('address') }} - {{ $order->user->name }}</p>
	    </div>
	</div>
</div>

	<script>
		window.print()
		window.location.href = "{{ route('order.index') }}"
	</script>

</body>


</html>