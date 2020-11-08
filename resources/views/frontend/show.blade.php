@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header d-flex">
                <b>Create Posts</b>
                <a href="{{route('posts.index')}}" class="btn btn-primary btn-sm ml-auto"> Post</a>
                </div>
                
               

                <div class="card-body">
                    <div class="row">
                        @if($post->image != '')
                            <div class="col-12 text-center">
                            <img src="{{asset('assets/images/'.$post->image)}}" alt="{{$post->title}}" class="img-fluid" style="max-width:100%">
                            </div>
                        @endif
                        <div class="col-12 justify-content-center pt-5">
                            <h2>{{$post->title}}</h2>
                            <small>{{$post->Category->name}} BY: {{$post->user->name}}</small>
                            <p>
                            {!! $post->body !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
