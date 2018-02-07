@extends ('layouts.app')

@section ('content')
<div class="container">
	<div class="card bg-light mt-4">
		<div class="card-body">
			<h3 class="card-title">Redigér ønske</h3>	
			{!! Form::open(['action' => ['ItemController@update', $item->id], 'method' => 'POST', 
				'enctype' => 'multipart/form-data']) !!}
			<div class="form-group mt-4">
				{{Form::label('title', 'Titel')}}
				{{Form::text('title', $item->title, 
					['class' => 'form-control', 'placeholder' => 'Ønskets navn'])}}
			</div>  
			<div class="form-group mt-4">
				{{Form::label('category', 'Kategori')}}
				<select id="category" name="category" class="custom-select form-control">
					<option></option>
					@foreach (Auth::user()->categories as $category)
						<option value="{{$category->id}}"
						@if ($category->id == $item->category_id)
							selected
						@endif
						>{{$category->name}}</option>
					@endforeach
				</select>
			</div>                
			<div class="form-group mt-4">
				{{Form::label('link', 'Link til en side')}}
				{{Form::text('link', $item->link, ['class' => 'form-control', 
					'placeholder' => 'link-til-dit-ønske.com'])}}
			</div>                 
			<div class="form-group mt-4">
				{{Form::textarea('body', $item->body, ['id' => 'article-ckeditor',
					 'class' => 'form-control', 'placeholder' => 'Noget tekst om dit ønske'])}}
			</div>
				{{Form::submit('Gem ændringer', ['class' => 'btn btn-primary mr-2'])}}
				<a class="btn btn-danger" 
					href="/wishlists/{{ Auth::user()->wishlist->id}}/edit">
						Tilbage
				</a>
				{{Form::hidden('_method', 'PUT')}}        
			{!! Form::close() !!}   
		</div>
	</div>
</div>
@endsection
