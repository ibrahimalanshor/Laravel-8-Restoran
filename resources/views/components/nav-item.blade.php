<li class="nav-item">
    <a class="nav-link {{ $active ? 'active' : '' }}" @isset($target) data-toggle="collapse" aria-expanded="false" data-target="#{{$target}}" aria-controls="{{$target}}" @endisset {{ $attributes }}>@isset($icon)<i class="fa fa-fw fa-{{ $icon }}"></i>@endisset {{ $name }}</a>
    @isset($target)
	    <div id="{{ $target }}" class="collapse submenu {{ $active ? 'show' : '' }}" ">
	        <ul class="nav flex-column">
	        	{{ $menu }}
	        </ul>
	    </div>
    @endisset
</li>