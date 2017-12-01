@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid" >
	<div class="container">
		<h1 class="display-4 d-none d-sm-block">Instrumentbræt</h1>
		<h1 class="d-block d-sm-none mb-2">Instrumentbræt</h1>
		<p class="lead">Her kan du oprette, redigere eller slette din ønskeseddel
		</p>
		@if (count(Auth::user()->wishlist) < 1) 
			<a class="btn btn-lg btn-success" href="wishlists/create">Opret ønskeseddel</a>
		@else
			<a class="btn btn-lg btn-primary" 
			href="wishlists/{{Auth::user()->wishlist->id}}/edit">Redigér ønskeseddel</a>
		@endif
	</div>
</div>
@if (count(Auth::user()->wishlist) > 0)
<div class="container mb-4">
	<div class="card mt-4">
		<div class="card-body">
			<div class="row">
				<div class="col-md-8">
					<h2 class="card-title mb-4">
						{{ Auth::user()->wishlist->title }}
					</h2>
				</div>
				<div class="col-md-4">	
					{!!Form::open(['action' => ['WishlistController@destroy',
						 Auth::user()->wishlist->id],
						'method' => 'POST',	'onsubmit' => 
							'return confirm("Er du sikker på at du vil slette?")'])!!}
	  					{{Form::hidden('_method', 'DELETE')}}
						{{Form::submit('Slet ønskeseddel',
							 ['class' => 'btn btn-danger btn-lg float-md-right'])}}
	 				{!!Form::close()!!}
				</div>
			</div>
			<p class="card-text">
				@if (count(Auth::user()->wishlist->items) > 0)
					@foreach (Auth::user()->wishlist->items as $item)
					<div class="card bg-light  mb-2">
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
					<div class="card bg-light ml-4 mr-4 mb-2">
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<h4 class="card-title">
										Der er ingen ønsker på denne 
									</h4>
								</div>
							</div>
						</div>
					</div>
				@endif	
			</p>
		</div>
	</div>	
</div>
@endif
@endsection
