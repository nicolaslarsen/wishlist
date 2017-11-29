@extends ('layouts.app')

@section ('content')

<div class="container">
	<div class="card bg-light mt-4">
		<div class="card-body">
			<div class="col-md-6">
				<h3 class="card-title">Opret ønskeseddel</h3>	
				<p class="card-text">
{!! Form::open(['action' => 'WishlistController@store', 'method' => 'POST', 
	'enctype' => 'multipart/form-data']) !!}
	<div class="form-group mt-4">
		{{Form::label('title', 'Titel')}}
		{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Ønskesedlens navn', 
			'autofocus', 'required'])}}
	</div>                 
		{{Form::submit('Opret ønskeseddel', ['class' => 'btn btn-primary mr-2'])}}
	<a href="/home" class="btn btn-danger">Tilbage</a>
{!! Form::close() !!}   
				</p>
			</div>
		</div>
	</div>
</div>
@endsection
