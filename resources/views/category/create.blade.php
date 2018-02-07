@extends ('layouts.app')

@section ('content')
<div class="container"> <div class="card bg-light mt-4"> <div class="card-body"> <h3 class="card-title">Tilføj kategori</h3>	{!! Form::open(['action' => 'CategoryController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
				<div class="form-group mt-4">
				{{Form::label('name', 'Navn')}}
				{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Kategoriens navn',
					'required' => 'required', 'autofocus' => 'autofocus'])}}
				</div>                
				<div class="card mb-4">
					<div class="card-body">
						<h3 class="card-title">Tilføj ønsker til kategori</h3>
						@foreach ($uncategorized as $item)
						<div class="card bg-light mb-2">
							<div class="card-body">
								<div class="row">
									<div class="col-8">
										<h5 class="card-title">
											<a href="/items/{{$item->id}}" >
												{{$item->title}}
											</a>
										</h5>
									</div>
									<div class="col-4">
										{{Form::checkbox('checkbox[]', $item->id, null, 
											['class' => 'float-right'])}}
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				{{Form::submit('Opret kategori', ['class' => 'btn btn-primary mr-2'])}}
				<a href="/wishlists/{{Auth::user()->wishlist->id}}/edit" class="btn btn-danger">Tilbage</a>
			{!! Form::close() !!}   
		</div>
	</div>
</div>
@endsection
