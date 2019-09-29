@extends('layouts.backend') <!-- Part 37 -->

<!-- Part 37 -->
@section('content')

<h1>Edit city</h1>
<form {{ $novalidate /* Part 38 */ }} method="POST" action="{{ route('cities.update',['id'=>$city->id]) /* Part 38 */ }}">
<h3>Name * </h3>
<input class="form-control" value="{{ $city->name /* Part 38 */ }}" type="text" required name="name"><br>
<button class="btn btn-primary" type="submit">Save <!-- Part 38 --></button>
{{ csrf_field() /* Part 38 */ }}
{{ method_field('PUT') /* Part 38 */ }}
</form>

@endsection
