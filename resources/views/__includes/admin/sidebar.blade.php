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

                    <x-nav-item icon="user-circle" name="Dashboard" :active="active('admin')" href="{{ route('admin.home') }}" />

                    <x-nav-item icon="archive" name="Menus" target="menu" :active="active('admin/menu', 'group')" href="#">
                        <x-slot name="menu">
                            <x-nav-item name="Data Menu" :active="active('admin/menu')" href="{{ route('admin.menu.index') }}" />
                            <x-nav-item name="New Menu" :active="active('admin/menu/create')"  href="{{ route('admin.menu.create') }}" />
                        </x-slot>
                    </x-nav-item>
                                         
                    <x-nav-item icon="list-alt" name="Categories" :active="active('admin/category')" href="{{ route('admin.category.index') }}" />

                    <x-nav-item icon="table" name="Tables" :active="active('admin/table')" href="{{ route('admin.table.index') }}" />

                    <li class="nav-divider">
                        Site
                    </li>

                    <x-nav-item icon="user-circle" name="User" :active="active('admin/user')" href="{{ route('admin.user.index') }}"></x-nav-item>

                    <x-nav-item icon="cog" name="Setting" :active="active('admin/setting')" href="{{ route('admin.setting.index') }}"></x-nav-item>

                </ul>
            </div>
        </nav>
    </div>
</div>