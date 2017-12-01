@extends ('layouts.app') 
@section ('content')

@guest
<div class="alert alert-info">{{$info}}</div>
@endguest

<div class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1 class="display-4 d-none d-sm-block">{{ $wishlist->title }}</h1>
				<h1 class="d-block d-sm-none mb-2">{{ $wishlist->title }}</h1>	
			</div>
			<div class="col-md-4">
				<a class="btn btn-danger btn-lg text-white float-md-right"
					onclick="window.history.back()">
					Tilbage
				</a>
			</div>
		</div>
	</div>
</div>

<div class="container mb-4">
	<div class="card">
		<div class="card-body">
			<h2 class="card-title">Ønsker</h2>
			<p class="card-text">
				@if (count($wishlist->items) > 0)
				@foreach ($wishlist->items as $item)
					<div class="card bg-light mb-2">
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<h4 class="card-title">
										<a href="/items/{{$item->id}}">
											{{$item->title}}
										</a>
									</h4>
								</div>
								<div class="col-md-4">
									@if (count($item->link) > 0)
									<a class="btn btn-info float-md-right" 
										href="{{$item->link}}" target="_blank">
										Link til side
									</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
				@else
					<div class="card bg-light mb-2">
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<h4 class="card-title">
										Der er ingen ønsker på denne lister														</h4>
								</div>
							</div>
						</div>
					</div>
				@endif
			</p>
		</div>
	</div>
</div>
@endsection
