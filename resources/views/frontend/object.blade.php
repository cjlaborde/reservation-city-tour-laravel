@extends('layouts.frontend') <!-- Part 5  -->

@section('content') <!-- Part 5  -->
<div class="container-fluid places">

    <h1 class="text-center">{{ $object->name }} <!-- Part 16 --> object  <small>{{ $object->city->name }} <!-- Part 16 --></small></h1>

    <p>{{ $object->description }} <!-- Part 16 --></p>


    <ul class="nav nav-tabs">
        <li class="active"><a href="#gallery" data-toggle="tab" aria-expanded="true">Image gallery</a></li>
        <li><a href="#people" data-toggle="tab" aria-expanded="true">Object is liked <span class="badge">{{ $object->users->count() }} <!-- Part 16 --></span></a></li>
        <li><a href="#adress" data-toggle="tab" aria-expanded="false">Address</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="gallery">

        @foreach($object->photos->chunk(3) as $chunked_photos) <!-- Part 16 -->

            <div class="row top-buffer">

            @foreach($chunked_photos as $photo) <!-- Part 16 -->

                <div class="col-md-4">
                    <img class="img-responsive" src="{{ $photo->path ?? $placeholder }}" alt=""> <!-- Part 16 src -->
                </div>

            @endforeach <!-- Part 16 -->

            </div>

        @endforeach <!-- Part 16 -->

        </div>
        <div class="tab-pane fade" id="people">

            <ul class="list-inline">
            @foreach( $object->users as $user) <!-- Part 16 -->
                <li><a href="{{ route('person',['id'=>$user->id]/* Part 23 */) }}"><img title="{{ $user->FullName /* Part 16 */ }}" class="media-object img-responsive" width="50" height="50" src="{{ $user->photos->first()->path ?? $placeholder /* Part 16 */ }}" alt="..."> </a></li>

            @endforeach <!-- Part 16 -->
            </ul>


        </div>
        <div class="tab-pane fade" id="adress">
            <p>{{ $object->address->street }} {{ $object->address->number }} <!-- Part 16 --></p>
        </div>
    </div>

    <section>

        <h2 class="text-center">Object rooms</h2>

    @foreach($object->rooms->chunk(4) as $chunked_rooms) <!-- Part 16 -->

        <div class="row">

        @foreach($chunked_rooms as $room) <!-- Part 16 -->

            <div class="col-md-3 col-sm-6">

                <div class="thumbnail">
                    <img class="img-responsive img-circle" src="{{ $room->photos->first()->path ?? $placeholder /* Part 16 */ }}" alt="...">
                    <div class="caption">
                        <h3>Nr {{ $room->room_number}} <!-- Part 16 --></h3>
                        <p>{{ str_limit($room->description,70) }} <!-- Part 16 --> </p>
                        <p><a href="{{ route('room',['id'=>$room->id]/* Part 20 */) }}" class="btn btn-primary" role="button">Details</a><a href="{{ route('room',['id'=>$room->id]/* Part 20 */) }}#reservation" class="btn btn-success pull-right" role="button">Reservation</a></p>
                    </div>
                </div>
            </div>

        @endforeach <!-- Part 16 -->


        </div>

    @endforeach <!-- Part 16 -->

    </section>

    <section>
        <h2 class="green">Object comments</h2>
    @foreach( $object->comments as $comment ) <!-- Part 16 -->
        <div class="media">
            <div class="media-left media-top">
                <a title="{{ $comment->user->FullName /* Part 16 */ }}" href="{{ route('person',['id'=>$comment->user->id]/* Part 23 */) }}">
                    <img class="media-object" width="50" height="50" src="{{ $comment->user->photos->first()->path ?? $placeholder /* Part 16 */ }}" alt="...">
                </a>
            </div>
            <div class="media-body">
            {{ $comment->content }} <!-- Part 16 -->
            {!! $comment->rating !!} <!-- Part 16 -->
            </div>
        </div>
        <hr>
    @endforeach <!-- Part 16 -->
    </section>

    <!-- Part 25 -->
    @auth
        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Add comment
        </a>
    @else
        <p><a href="{{ route('login') }}">Login to add a comment</a></p>
    @endauth


    <div class="collapse" id="collapseExample">
        <div class="well">


            <form method="POST" action="{{ route('addComment',['object_id'=>$object->id, 'App\TouristObject'])/* Part 25 */ }}" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Comment</label>
                        <div class="col-lg-10">
                            <textarea required name="content" class="form-control" rows="3" id="textArea"></textarea>
                            <span class="help-block">Add a comment about this object.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Rating</label>
                        <div class="col-lg-10">
                            <select name="rating" class="form-control" id="select">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </fieldset>
            {{ csrf_field() }} <!-- Part 25 -->
            </form>

        </div>
    </div>

    <section>
        <h2 class="red">Articles about the object / area</h2>
    @foreach($object->articles as $article) <!-- Part 16 -->
        <div class="articles-list">
            <h4 class="top-buffer">{{ $article->title }} <!-- Part 16 --></h4>
            <p><b> {{ $article->user->FullName }} <!-- Part 16 --></b>
                <i>{{ $article->created_at }} <!-- Part 16 --></i>
            </p>
            <p>{{ str_limit($article->content,250) }} <!-- Part 16 --> </p> <a href="{{ route('article',['id'=>$article->id]/* Part 22 */) }}">More</a>
        </div>

    @endforeach <!-- Part 16 -->
    </section>

    <!-- Part 24 -->
    @auth

        @if( $object->isLiked() )
            <a href="{{ route('unlike',['id'=>$object->id,'type'=>'App\TouristObject']) }}" class="btn btn-primary btn-xs top-buffer">Unlike this object</a>
        @else
            <a href="{{ route('like',['id'=>$object->id,'type'=>'App\TouristObject']) }}" class="btn btn-primary btn-xs top-buffer">Like this object</a>
        @endif

    @else

        <p><a href="{{ route('login') }}">Login to like this object</a></p>

    @endauth

</div>
@endsection <!-- Part 5  -->

