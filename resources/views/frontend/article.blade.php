<!--
|--------------------------------------------------------------------------
| resources/views/frontend/article.blade.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
-->
@extends('layouts.frontend') <!-- Part 5  -->

@section('content') <!-- Part 5  -->
<div class="container">

    <h1>Article <small>about: <a href="{{ route('object',['id'=>$article->object->id]/* Part 22 */) }}">{{ $article->object->name /* Part 22 */ }}</a> object</small></h1>
    <p>{{ $article->content /* Part 22 */ }}</p>


    <a class="btn btn-primary top-buffer" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Article is liked <span class="badge">{{ $article->users->count() /* Part 22 */ }}</span>
    </a>
    <div class="collapse" id="collapseExample">
        <div class="well">

            <ul class="list-inline">
            @foreach( $article->users as $user ) <!-- Part 22 -->
                <li><a href="{{ route('person',['id'=>$user->id]/* Part 22 */) }}"><img title="{{ $user->FullName /* Part 22 */ }}" class="media-object img-responsive" width="50" height="50" src="{{ $user->photos->first()->path ?? $placeholder /* Part 22 */ }}" alt="..."> </a></li>

            @endforeach <!-- Part 22 -->
            </ul>


        </div>
    </div>

    <h3>Comments</h3>

@foreach( $article->comments as $comment ) <!-- Part 22 -->
    <div class="media">
        <div class="media-left media-top">
            <a href="{{ route('person',['id'=>$comment->user->id]/* Part 22 */) }}">
                <img class="media-object" width="50" height="50" src="{{ $comment->user->photos->first()->path ?? $placeholder /* Part 22 */ }}" alt="...">
            </a>
        </div>
        <div class="media-body">
            {{ $comment->content /* Part 22 */ }}
        </div>
    </div>
    <hr>
@endforeach <!-- Part 22 -->

    <!-- Part 24 -->
    @auth

        @if( $article->isLiked() )
            <a href="{{ route('unlike',['id'=>$article->id,'type'=>'App\Article']) }}" class="btn btn-primary btn-xs top-buffer">Unlike this article</a>
        @else
            <a href="{{ route('like',['id'=>$article->id,'type'=>'App\Article']) }}" class="btn btn-primary btn-xs top-buffer">Like this article</a>
        @endif

    @else

        <p><a href="{{ route('login') }}">Login to like this article</a></p>

    @endauth


    <br><br>

    <!-- Part 25 -->
    @auth
        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
            Add comment
        </a>
    @else
        <p><a href="{{ route('login') }}">Login to add a comment</a></p>
    @endauth


    <div class="collapse" id="collapseExample2">
        <div class="well">


            <form method="POST" action="{{ route('addComment',['article_id'=>$article->id, 'App\Article']) /* Part 25 */ }}" class="form-horizontal">
                <fieldset>

                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Comment</label>
                        <div class="col-lg-10">
                            <textarea required name="content" class="form-control" rows="3" id="textArea"></textarea>
                            <span class="help-block">Add a comment about this article.</span>
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


</div>
@endsection <!-- Part 5  -->


