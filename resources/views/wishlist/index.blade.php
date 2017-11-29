@extends ('layouts.app')

@section ('content')
<div class="jumbotron">
	<div class="container">
		<h1 class="display-3">Ønskesedler</h1>
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

<div class="container">

<?php $counter = 0; ?>
@foreach ($wishlists as $wishlist)
@if ($counter % 2 == 0)
	<div class="row">
@endif
<div class="col-md-6">
	<div class="card bg-light mt-4">
		<div class="card-body">
			<h2 class="card-title">
				<a href="/wishlists/{{$wishlist->id}}">{{ $wishlist->title }}</a>
				<hr>
			</h2>
			<p class="card-text">
				<div class="row">
					<div class="col-md-8">
						Ønskeseddel oprettet af {{ $wishlist->user->name }}
						<br>
						<small class="text-muted">{{ $wishlist->created_at }}</small>
					</div>
					<div class="col-md-4">
				@if (!Auth::guest())
					@if (Auth::user()->id == $wishlist->user->id)
						{!!Form::open(['action' => ['WishlistController@destroy', $wishlist->id],
							'method' => 'POST', 'class' => 'float-right',
							'onsubmit' => 
								'return confirm("Er du sikker på at du vil slette?")'])!!}
    					{{Form::hidden('_method', 'DELETE')}}
    					{{Form::submit('Slet', ['class' => 'btn btn-danger'])}}
   						{!!Form::close()!!}
						<a class="btn btn-primary float-right mr-2" href="/wishlists/{{$wishlist->id}}/edit">
							Redigér
						</a>
					@endif
				@endif
					</div>
				</div>
			</p>
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
</div>
@endsection
