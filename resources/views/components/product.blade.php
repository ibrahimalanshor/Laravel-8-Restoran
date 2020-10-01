@forelse($menus as $menu)
	<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 menu" id="{{ $menu->id }}">
	    <div class="product-thumbnail">
	        <div class="product-img-head">
	            <div class="product-img p-0">
	                <img src="{{ photo($menu->photo) }}" alt="" class="img-fluid" style="height: 150px; width: 100%; object-fit: cover;">
	            </div>
	        </div>
	        <div class="product-content">
	            <div class="product-content-head">
	                <h3 class="product-title title">{{ $menu->name }}</h3>
	                <div class="product-price mt-3">Rp <span class="price">{{ $menu->price }}</span></div>
	            </div>
	            <div class="product-btn">
	                <button class="btn btn-sm btn-primary add-cart">Add to Cart</button>
	                <a href="{{ route('order.detail', $menu->id) }}" target="__blank" class="btn btn-sm btn-outline-light">Details</a>
	            </div>
	        </div>
	    </div>
	</div>
@empty
	<div class="col">
		<x-card>
			<h3 class="text-muted mb-0">Empty Menu</h3>
		</x-card>
	</div>
@endforelse
