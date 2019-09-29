@extends('layouts.frontend') <!-- Part 5  -->

@section('content') <!-- Part 5  -->
<div class="container-fluid places">

    <!-- Part 18 -->
    @if (session('norooms'))
    <p class="text-center red bolded">
        {{ session('norooms') }}
    </p>
    @endif
    <h1 class="text-center">Interesting places</h1>

    @foreach($objects->chunk(4) as $chunked_object) <!-- Part 14 -->

        <div class="row">

            @foreach($chunked_object as $object) <!-- Part 14 -->

                <div class="col-md-3 col-sm-6">

                    <div class="thumbnail">
                        <img class="img-responsive" src="{{ $object->photos->first()->path ?? $placeholder /* Part 44 $placeholder */ }}" alt="..."> <!-- Part 14 src -->
                        <div class="caption">
                            <h3>{{ $object->name }} <!-- Part 14 -->  <small>{{ $object->city->name  }}<!-- Part 14 --></small> </h3>
                            <p>{{ str_limit($object->description,100) }}<!-- Part 14 --></p>
                            <p><a href="{{ route('object',['id'=>$object->id]) }}" class="btn btn-primary" role="button">Details</a></p> <!-- Part 15 ['id'=>$object->id] -->
                        </div>
                    </div>
                </div>

            @endforeach <!-- Part 14 -->


        </div>

    @endforeach <!-- Part 14 -->

    {{ $objects->links() }} <!-- Part 15 -->

</div>
@endsection <!-- Part 5  -->
