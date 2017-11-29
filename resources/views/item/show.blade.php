@extends ('layouts.app') 
@section ('content')

@guest
@if (count($item->link) > 0)
<div class="alert alert-info">{{$info}}</div>
@endif
@endguest

<div class="jumbotron mb-0">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				@if (count($item->link) > 0)
				<a href="{{$item->link}}" target="_blank">
				@endif
					<h1 class="display-4">
						{{ $item->title }}	
					</h1>
				@if (count($item->link) > 0)
				</a>
				@endif
			</div>
			<div class="col-md-4">
				<a class="btn btn-danger btn-lg text-white float-right"
					onclick="window.history.back()">
						Tilbage
				</a>
			</div>
		</div>
	</div>
</div>

<div class="container">
		<div class="card bg-light">
		<div class="card-body">
			<div class="card-title">
				<h3>Beskrivelse</h3>
			</div>
			<hr>
			<p class="card-text">	
				<font size="5">
					@if (count($item->body) > 0)
					{!! $item->body !!}
					@else
					<div class="text-muted">
						Der er ingen beskrivelse til dette ønske
					</div>
					@endif
				</font>
			</p>
		</div>
	</div>
</div>
@endsection
