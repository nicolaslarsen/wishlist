@extends ('layouts.app')

@section ('content')
@foreach ($checkboxes as $test)
<p id="test">
	{{$test}}
	</p>
@endforeach
@endsection
