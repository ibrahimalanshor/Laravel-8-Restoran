<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>

                    <x-nav-item icon="tachometer-alt" name="Dashboard" href="{{ route('home') }}" :active="active('/')" />

                    <x-nav-item icon="shopping-cart" name="Orders" href="#" :active="active('order', 'group')" target="order">
                        <x-slot name="menu">
                            <x-nav-item name="Data Order" href="{{ route('order.index') }}" :active="active('order')" />
                            <x-nav-item name="New Order" href="{{ route('order.create') }}" :active="active('order/create')" />
                        </x-slot>
                    </x-nav-item>

                    <x-nav-item icon="table" name="Tables" href="{{ route('table.index') }}" :active="active('table')" />

                </ul>
            </div>
        </nav>
    </div>
</div>