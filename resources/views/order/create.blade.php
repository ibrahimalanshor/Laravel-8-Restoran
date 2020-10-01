@extends('__layouts.app', ['url' => ['order', 'All Menu']])

@section('title', 'All Menu')

@section('content')

<div class="col">
	<div class="row">
	    
	    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12 col-12">
    		<div class="row" id="product">
    			<x-product :menus=$menus></x-product>
    		</div>
    		<div id="pagination">
    			{{ $menus->links() }}
    		</div>
	    </div>	    

		<div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-12">
		<div class="product-sidebar mb-4">
	    <form action="{{ route('order.store') }}" method="post" id="checkout">
	    	@csrf
	    	<div class="product-sidebar-widget">
		        <h4 class="mb-0">Checkout</h4>
		    </div>
		    <div class="product-sidebar-widget">
		    	<h4 class="product-sidebar-widget-title">Cart</h4>
		    	<ul class="list-group mb-3" id="cart">
		    		<li class="list-group-item empty">Empty</li>
		    	</ul>
		    </div>
		    <div class="product-sidebar-widget">
		    	<h4 class="product-sidebar-widget-title">No Table</h4>
		    	<div class="form-group">
		    		<select name="table_id" class="form-control custom-select">
		    			@forelse($tables as $table)
		    				<option value="{{ $table->id }}">Table {{ $table->no }}</option>
		    			@empty
		    				<option disabled>Empty Table</option>
		    			@endforelse
		    		</select>
		    	</div>
	        	<button class="btn btn-sm btn-block btn-primary mt-3 checkout" disabled>Checkout</button>
		    </div>
	    </form>
		</div>
		<div class="product-sidebar">
		    <div class="product-sidebar-widget">
		        <h4 class="mb-0">Menu Filter</h4>
		    </div>
		    <div class="product-sidebar-widget">
		        <h4 class="product-sidebar-widget-title">Search</h4>
		        <form id="search">
		        	@csrf
		        	<div class="form-group">
			        	<input type="text" class="form-control" placeholder="Search" name="name" value="{{ $name ?? '' }}">
			        </div>
			        <div class="form-group">
			        	<button class="btn btn-sm btn-block btn-primary">Search</button>
			        </div>
		        </form>
		    </div>
			<form id="category">
				@csrf
				<div class="product-sidebar-widget">
			        <h4 class="product-sidebar-widget-title">Category</h4>

			        @forelse($categories as $category)
				        <div class="custom-control custom-checkbox">
				            <input type="checkbox" class="custom-control-input" name="category[]" id="category-{{ $category->id }}" value="{{ $category->id }}" @isset($checked) {{ in_array($category->id, $checked) ? 'checked' : '' }} @endisset>
				            <label class="custom-control-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
				        </div>
				    @empty
				    	Empty Category
			        @endforelse
			    </div>
			    <div class="product-sidebar-widget">
			        <button type="submit" class="btn btn-xs btn-primary">Apply Filter</button>
			        <a href="{{ route('order.create') }}" class="btn btn-xs btn-outline-light">Reset Filter</a>
			    </div>
			</form>
		</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')

	<script>
		let orderDetailUrl = "{{ route('order.detail', ':id') }}"
		let searchUrl = "{{ route('order.search') }}"
		let categoryUrl = "{{ route('order.category') }}"
		let asset = "{{ asset('storage/images/') }}"
	</script>

	<script src="{{ asset('js/create_order.js') }}"></script>

@endpush