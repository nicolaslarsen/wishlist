@extends ('layouts.app')

@section ('content')

<div class="container">
	<div class="card bg-light mt-4">
		<div class="card-body">
			<h3 class="card-title">Tilføj ønske</h3>	
			{!! Form::open(['action' => 'ItemController@store', 'method' => 'POST', 
				'enctype' => 'multipart/form-data']) !!}
			<div class="form-group mt-4">
				{{Form::label('title', 'Titel')}}
				{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Ønskets navn',
					'required' => 'required', 'autofocus' => 'autofocus'])}}
			</div>                 
			<div class="form-group mt-4">
				{{Form::label('link', 'Link til en side')}}
				{{Form::text('link', '', ['class' => 'form-control', 
					'placeholder' => 'link-til-dit-ønske.com'])}}
			</div>                 
			<div class="form-group mt-4">
				{{Form::textarea('body', '', ['id' => 'article-ckeditor',
					 'class' => 'form-control'])}}
			</div>
				{{Form::submit('Opret ønske', ['class' => 'btn btn-primary mr-2'])}}
				<a class="btn btn-danger" 
					href="/wishlists/{{ Auth::user()->wishlist->id}}/edit">
						Tilbage
				</a>
			{!! Form::close() !!}   
		</div>
	</div>
</div>
@endsection
