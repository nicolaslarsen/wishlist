@extends ('layouts.app')

@section ('content')

<div class="container mb-4">
	<div class="card bg-light mt-4">
		<div class="card-body">
			<div class="row">
				<div class="col-md-8">
					<h3 class="card-title">
						Redigér ønskeseddel
					</h3>	
				</div>
				<div class="col-md-4">
					<a href="/home" class="btn btn-danger float-md-right">Tilbage</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					{!! Form::open(['action' => ['WishlistController@update', 
						$wishlist->id],
					'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
					<div class="form-group mt-4">
						{{Form::label('title', 'Titel')}}
						{{Form::text('title', $wishlist->title, 
							['class' => 'form-control', 
							'placeholder' => 'Ønskesedlens navn'])}}
					</div>                 
					{{Form::submit('Skift titel', 
						['class' => 'btn btn-lg btn-primary mr-2'])}}
					{{Form::hidden('_method', 'PUT')}}        
					{!! Form::close() !!}   
				</div>
			</div>
			
			<div class="card mt-4">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<h3 class="card-title">Ønsker</h3>
						</div>
						<div class="col-md-6">
							<a href="/items/create" 
								class="btn btn-success btn-lg float-md-right">
								Tilføj ønske
							</a>
							<a href="/categories/create" 
								class="btn btn-primary btn-lg float-md-right mr-2">
								Tilføj kategori
							</a>
						</div>
					</div>
					@if (count($wishlist->items) < 1)
					<p class="mt-4">Du har ingen ønsker i øjeblikket</p>	
					@else
					@foreach ($wishlist->items as $item)
						<div class="card bg-light mt-4">
							<div class="card-body">
								<div class="row">
									<div class="col-md-8">
										<h3 class="card-title">
											<a href="/items/{{ $item->id }}">
												{{ $item->title }}
											</a>
										</h3>
										<small class="text-muted">
											Tilføjet {{ $item->created_at }}
										</small>
									</div>
									<div class="col-md-4">
										{!!Form::open(
											['action' => 
												['ItemController@destroy',
													 $item->id],
											'method' => 'POST', 
												'class' => 'float-md-right',
											'onsubmit' => 
												'return confirm(
													"Er du sikker på at du vil slette?")'])!!}
	    									{{Form::hidden('_method', 'DELETE')}}
											{{Form::submit('Slet', 
												['class' => 'btn btn-danger float-left 
																float-md-right mr-2 mt-4'])}}
	   									{!!Form::close()!!}
										<a class="btn btn-primary float-left float-md-right mr-2 mt-4" 
											href="/items/{{$item->id}}/edit">
											Redigér
										</a>
									</div>
								</div>
							</div>
						</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
