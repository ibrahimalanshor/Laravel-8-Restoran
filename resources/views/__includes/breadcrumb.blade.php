@foreach($breadcrumb as $name)
	@if($loop->last)
		<li class="breadcrumb-item active">{{ $name }}</li>
	@elseif($loop->first)
		<li class="breadcrumb-item"><a href="{{ url(strtolower($name)) }}" class="breadcrumb-link">{{ $name }}</a></li>
	@else
		<li class="breadcrumb-item"><a href="{{ url($breadcrumb[$loop->index - 1].'/'.$name) }}" class="breadcrumb-link">{{ $name }}</a></li>
	@endif
@endforeach