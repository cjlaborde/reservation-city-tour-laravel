@extends('layouts.backend') <!-- Part 5 -->

@section('content') <!-- Part 5 -->
<h2>List of objects</h2>
@foreach( $objects as $object ) <!-- Part 46 -->

    <div class="panel panel-success top-buffer">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $object->name /* Part 46 */ }} object <small><a href="{{ route('saveObject',['id'=>$object->id]) /* Part 46 */ }}" class="btn btn-danger btn-xs">edit</a> <a href="{{ route('saveRoom').'?object_id='.$object->id /* Part 47 */ }}" class="btn btn-danger btn-xs">add a room</a> <a title="delete" href="{{ route('deleteObject',['id'=>$object->id]) /* Part 46 */}}"><span class="glyphicon glyphicon-remove"></span></a></small> </h3>
        </div>

        <div class="panel-body">
            @foreach( $object->rooms as $room ) <!-- Part 46 -->
                <span class="my_objects">
                    Room {{ $room->room_number /* Part 47 */ }} <a title="edit" href="{{ route('saveRoom',['id'=>$room->id]) /* Part 47 */ }}"><span class="glyphicon glyphicon-edit"></span></a> <a title="delete" href="{{ route('deleteRoom',['id'=>$room->id]) /* Part 47 */ }}"><span class="glyphicon glyphicon-remove"></span></a> </span>
            @endforeach <!-- Part 46 -->
        </div>

    </div>

@endforeach <!-- Part 46 -->
@endsection <!-- Part 5 -->
