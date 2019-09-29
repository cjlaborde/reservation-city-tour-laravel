@extends('layouts.frontend') <!-- Part 5  -->

@section('content') <!-- Part 5  -->
<div class="container-fluid places">

    <h1 class="text-center">Available rooms</h1>

    {{-- divide collection into 4 elements with chunk --}}
    @foreach( $city->rooms->chunk(4) as $chunked_rooms ) <!-- Part 19 -->

        <div class="row">

            @foreach( $chunked_rooms as $room ) <!-- Part 19 -->

                <div class="col-md-3 col-sm-6">

                    <div class="thumbnail">
                        <img class="img-responsive img-circle" src="{{ $room->photos->first()->path ?? $placeholder /* Part 19 */ }}" alt="...">
                        <div class="caption">
                            <h3>Nr {{ $room->room_number /* Part 19 */ }} <small class="orange bolded">{{ $room->price /* Part 19 */ }}$</small> </h3>
                            <p>{{ str_limit($room->description,80) /* Part 19 */ }}</p>
                            <p><a href="{{ route('room',['id'=>$room->id]/* Part 19 */) }}" class="btn btn-primary" role="button">Details</a><a href="{{ route('room',['id'=>$room->id]/* Part 19 */) }}#reservation" class="btn btn-success pull-right" role="button">Reservation</a></p>
                        </div>
                    </div>
                </div>

            @endforeach <!-- Part 19 -->


        </div>

    @endforeach <!-- Part 19 -->

</div>
@endsection <!-- Part 5  -->

