<div class="card">
	@isset($title)
		<div class="card-header d-flex justify-content-between align-items-center {{ $smallTitle ? 'p-4' : '' }}">
			{!! $smallTitle ? '<a class="d-inline-block" href="'.route('home').'">'.$title.'</a>' : '<h4 class="card-header-title">'.$title.'</h4>' !!}
			@isset($toolbar)
				<div class="toolbar">
					{{ $toolbar }}
				</div>
			@endisset
		</div>
	@endisset
	
	@isset($collapse)
		<div class="card-body border-bottom collapse" id="collapse">
			{{ $collapse }}
		</div>
	@endisset
	
	<div class="card-body">
		{{ $slot }}
	</div>

	@isset($content)
		<div class="card-body border-top">
			{{ $content }}
		</div>
	@endisset

	{{ $footer ?? '' }}
</div>