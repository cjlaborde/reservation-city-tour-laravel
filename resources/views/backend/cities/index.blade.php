@extends('layouts.backend') <!-- Part 37 -->

<!-- Part 37 -->
@section('content')
<h1>Cities <small><a class="btn btn-success" href="{{ route('cities.create') /* Part 38 */ }}" data-type="button"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>New city </a></small></h1>

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <tr>
            <th>City name</th>
            <th>Edit / Delete</th>
        </tr>
        @foreach( $cities as $city ) <!-- Part 38 -->
            <tr>
                <td>{{ $city->name /* Part 38 */  }}</td>
                <td>
                    <a href="{{ route('cities.edit',['id'=>$city->id]) /* Part 38 */ }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

            <!-- Part 38 -->
            <form style="display: inline;" method="POST" action="{{ route('cities.destroy',['id'=>$city->id]) }}">
<button onclick="return confirm('Are you sure?');" class="btn btn-primary btn-xs" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
{{ method_field('DELETE') }}
{{ csrf_field() }}
           </form>

                </td>
            </tr>
        @endforeach <!-- Part 38 -->
    </table>
</div>

@endsection
