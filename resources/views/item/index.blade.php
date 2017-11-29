@extends ('layouts.app')

@section ('content')

@foreach ($items as $item)
	<p>{{ $item->title }}</p>
@endforeach

@endsection
