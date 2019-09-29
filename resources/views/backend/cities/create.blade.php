@extends('layouts.backend') <!-- Part 37 -->

<!-- Part 37 -->
@section('content')

<h1>Create new city</h1>
<form {{ $novalidate /* Part 38 */ }} method="POST" action="{{ route('cities.store') /* Part 38 */ }}">
<h3>Name * </h3>
<input class="form-control" type="text" required name="name"><br>
<button class="btn btn-primary" type="submit">Create</button>
{{ csrf_field() /* Part 38 */ }}
</form>

@endsection
