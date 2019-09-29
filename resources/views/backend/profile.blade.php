@extends('layouts.backend') <!-- Part 5 -->

@section('content') <!-- Part 5 -->
<h2>User data</h2>
<form {{ $novalidate /* Part 39 */ }} action="{{ route('profile') /* Part 39 */ }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
        <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Name *</label>
            <div class="col-lg-10">
                <input name="name" type="text" required class="form-control" id="name" value="{{ $user->name /* Part 39 */ }}">
            </div>
        </div>
        <div class="form-group">
            <label for="surname" class="col-lg-2 control-label">Last name *</label>
            <div class="col-lg-10">
                <input name="surname" type="text" required class="form-control" id="surname" value="{{ $user->surname /* Part 39 */ }}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">Email *</label>
            <div class="col-lg-10">
                <input name="email" type="email" required class="form-control" id="inputEmail" value="{{ $user->email /* Part 39 */ }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <label for="userPicture">Add your photo</label>
                <input name="userPicture" type="file" id="userPicture">
            </div>
        </div>

        @if( $user->photos->first() ) <!-- Part 39 -->
        <div class="col-lg-10 col-lg-offset-2">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail">
                        <img class="img-responsive" src="{{ $user->photos->first()->path ?? $placeholder /* Part 39 */ }}" alt="...">
                        <div class="caption">
                            <p><a href="{{ route('deletePhoto',['id'=>$user->photos->first()->id]) /* Part 39 */ }}" class="btn btn-primary btn-xs" role="button">Delete</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif <!-- Part 39 -->

    </fieldset>
    {{ csrf_field() /* Part 39 */ }}
</form>
@endsection <!-- Part 5 -->
