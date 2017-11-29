@extends ('layouts.app')

@section ('content')

<div class="container">
	<div class="card bg-light mt-4">
		<div class="card-body">
			<h3 class="card-title">
				Redigér ønskeseddel
			
				<a href="/home" class="btn btn-danger float-right">Tilbage</a>
			</h3>	
			<div class="row">
			<div class="col-md-6">
				{!! Form::open(['action' => ['WishlistController@update', $wishlist->id],
					'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
					<div class="form-group mt-4">
						{{Form::label('title', 'Titel')}}
						{{Form::text('title', $wishlist->title, ['class' => 'form-control', 
								'placeholder' => 'Ønskesedlens navn'])}}
					</div>                 
					{{Form::submit('Skift titel', ['class' => 'btn btn-lg btn-primary mr-2'])}}
					{{Form::hidden('_method', 'PUT')}}        
				{!! Form::close() !!}   
			</div>
			</div>
			
			<div class="card mt-4">
				<div class="card-body">
					<div class="row">
						<div class="col-md-8">
							<h3 class="card-title">Ønsker</h3>
						</div>
						<div class="col-md-4">
							<a href="/items/create" class="btn btn-success btn-lg float-right">
								Tilføj ønske
							</a>
						</div>
					</div>
					@if (count($wishlist->items) < 1)
						<p class="mt-4">Du har ingen ønsker i øjeblikket</p>	
					@else
						<?php $counter = 0 ?>
						@foreach ($wishlist->items as $item)
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
									<small class="text-muted">Tilføjet {{ $item->created_at }}</small>
									{!!Form::open(['action' => ['ItemController@destroy', $item->id],
										'method' => 'POST', 'class' => 'float-right',
										'onsubmit' => 
											'return confirm("Er du sikker på at du vil slette?")'])!!}
    									{{Form::hidden('_method', 'DELETE')}}
    									{{Form::submit('Slet', ['class' => 'btn btn-danger'])}}
   									{!!Form::close()!!}
									<a class="btn btn-primary float-right mr-2" 
										href="/items/{{$item->id}}/edit">
									Redigér
									</a>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
