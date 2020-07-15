@extends('layouts.app')

@section('content')
    <h1 class="text-center">News</h1>
    @guest
    @else
        @can('admins-only',Auth::user())
            <div>
                <a href="/posts/create" class="btn btn-primary">Add News</a>
            </div>
        @endcan
    @endguest
    <div class="row">
        @if(count($news) >= 1)
            @foreach($news as $post)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <a href="/posts/{{$post->id}}" >
{{--                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="grey"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$post->title}}</text></svg>--}}
                            <div class="card-img">


                                <img style="width: 100%; height: 220px;" src="/storage/cover_images/{{$post->cover_image}}"/>
                            </div>
                        </a>
                        <div class="card-body" style="width: 100%; height: 200px">
                            <p class="card-text">{!!substr($post->body,0,170)!!}.......</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Written by {{$post->author}}</small>
                                <div class="btn-group">
                                    <a href="/posts/{{$post->id}}"> <button type="button" class="btn btn-sm btn-outline-secondary">View</button> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$news->links()}}
        @else
            <p>No posts to show at the moment</p>
        @endif
    </div>


@endsection
