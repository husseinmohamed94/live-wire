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
                <form action="{{route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                   <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{old('title',$post->title)}}" class="form-control">
                        @error('title')<span class="text-danger">{{$message}}</span>@enderror
                   </div>

                   <div class="form-group">
                        <label for="category">category</label>
                        <select name="category" id="" class="form-control">
                        <option value=""></option>
                        @foreach($catgories as $category)
                            <option value="{{$category->id}}" {{ old ('category',$post->category->id) == $category->id ? 'selected' : '' }} >{{$category->name}}</option>
                        @endforeach
                        </select>
                        @error('category')<span class="text-danger">{{$message}}</span>@enderror
                   </div>

                   <div class="form-group">
                        <label for="body">body</label>
                        <textarea name="body"  cols="30"  rows="5"  class="form-control">{{old('body',$post->body)}}</textarea>
                        @error('body')<span class="text-danger">{{$message}}</span>@enderror
                   </div>
                    @if($post->image !== '')
                    <div class="form-group">
                        <img src="{{asset('assets/images/'.$post->image)}}" alt="{{$post->title}}" width="100px">

                    </div>
                    @endif    

                   <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image"  class="custom-file">
                        @error('image')<span class="text-danger">{{$message}}</span>@enderror
                   </div>

                   <div class="text-center">
                   <input type="submit" name="save" value="update Post" class="btn btn-primary">
                   </div> 

                </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 