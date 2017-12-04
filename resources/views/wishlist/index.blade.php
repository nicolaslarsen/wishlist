@extends ('layouts.app')

@section ('content')
<div class="jumbotron">
	<div class="container">
		<h1 class="display-3 d-none d-sm-block">Ønskesedler</h1>
		<h1 class="d-block d-sm-none mb-2">Ønskesedler</h1>
		<p class="lead">Her kan du se alle ønskesedler</p>	
		@guest
			<a class="btn btn-lg btn-success" href="/register">Lav bruger</a>
		@else
			@if (count(Auth::user()->wishlist) < 1)
				<a class="btn btn-lg btn-success" href="/wishlists/create">
					Opret ønskeseddel
				</a>	
			@endif
		@endguest
	</div>
</div>

<div class="container mb-4">

	@foreach ($wishlists as $wishlist)
	<div class="card bg-light mt-4">
		<div class="card-body">
			<h2 class="card-title">
				<a href="/wishlists/{{$wishlist->id}}">{{ $wishlist->title }}</a>
				<hr>
			</h2>
			<p class="card-text">
				<div class="row">
					<div class="col-md-8">
						<p>Oprettet af {{ $wishlist->user->name }}</p>
						<small class="text-muted">{{ $wishlist->created_at }}</small>
					</div>
					<div class="col-md-4">
						@if (!Auth::guest())
							@if (Auth::user()->id == $wishlist->user->id)
							{!!Form::open(['action' => ['WishlistController@destroy', $wishlist->id],
								'method' => 'POST', 'onsubmit' => 
									'return confirm("Er du sikker på at du vil slette?")'])!!}
    							{{Form::hidden('_method', 'DELETE')}}
								{{Form::submit('Slet',
								 	['class' => 'btn btn-danger float-left float-md-right mr-2 mt-4'])}}
   							{!!Form::close()!!}
							<a class="btn btn-primary float-left float-md-right mr-2 mt-4" 
								href="/wishlists/{{$wishlist->id}}/edit">
								Redigér
							</a>
							@endif
						@endif
					</div>
				</div>
			</p>
		</div>
	</div>
	@endforeach
</div>
@endsection
