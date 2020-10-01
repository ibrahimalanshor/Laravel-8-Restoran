<div class="row">
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pr-xl-0 pr-lg-0 pr-md-0  m-b-30">
                <div class="product-slider py-5 h-100 d-flex align-items-center">
                    <img src="{{ photo($menu->photo) }}" class="img-fluid"> 
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pl-xl-0 pl-lg-0 pl-md-0 border-left m-b-30">
                <div class="product-details">
                    <div class="border-bottom pb-3 mb-3">
                        <h2 class="mb-3">{{ $menu->name }}</h2>
                        <h3 class="mb-0 text-primary">{{ $menu->price }}</h3>
                    </div>
                    <div class="product-category pb-3 mb-3 border-bottom">
                        <h4>Category</h4>
                        @foreach($menu->categories as $category)
                            <span class="badge badge-success mb-2">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    <div class="product-description">
                        <h4 class="mb-1">Descriptions</h4>
                        <p>{{ $menu->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>