@extends('layouts.app')

@section('content')
<div class="jumbotron">
	<div class="container">
		<h1 class="display-3">Instrumentbræt</h1>
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
<div class="container">
	<div class="card mt-4">
		<div class="card-body">
			<h2 class="card-title">
				{{ Auth::user()->wishlist->title }}

				{!!Form::open(['action' => ['WishlistController@destroy',
					 Auth::user()->wishlist->id],
					'method' => 'POST', 'class' => 'float-right',
					'onsubmit' => 
						'return confirm("Er du sikker på at du vil slette?")'])!!}
  				{{Form::hidden('_method', 'DELETE')}}
  				{{Form::submit('Slet ønskeseddel', ['class' => 'btn btn-danger btn-lg'])}}
 				{!!Form::close()!!}
			</h2>
			<hr>
			<p class="card-text">
				@if (count(Auth::user()->wishlist->items) < 1)
				<p class="mt-4">Du har ingen ønsker i øjeblikket</p>	
				@else
				<?php $counter = 0 ?>
				@foreach (Auth::user()->wishlist->items as $item)
				@if ($counter % 2 == 0)
				<div class="row">
				@endif
					<div class="col-md-6">
						<div class="card bg-light mt-4">
							<div class="card-body">
								<h3 class="card-title">
									<a href="/items/{{ $item->id }}">
										{{ $item->title }}
									</a>
								</h3>
								<small class="text-muted">
									Tilføjet {{ $item->created_at }}
								</small>
							</div>
						</div>
					</div>
				@if ($counter % 2 == 1)
				</div>
				@endif
				<?php $counter++; ?>
				@endforeach
				@if ($counter % 2 == 1)
				</div>
				@endif
				@endif					
			</p>
		</div>
	</div>	
</div>
@endif
@endsection
