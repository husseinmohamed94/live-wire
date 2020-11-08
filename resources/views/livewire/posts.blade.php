<div>
    
        <div class="row justify-content-center">
            <div class="col-12">
        
                    <div class="card">
                        <div class="card-header d-flex">
                        <b>Posts</b>
                        <a href="javascript:void(0)" wire:click= "create_post" class="btn btn-primary btn-sm ml-auto">Create Post</a>
                        </div>
        
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th>Image</th>
                                      <th>Title</th>
                                      <th>owner</th>
                                      <th>Category</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                @foreach($posts as $post)
                                    <tr>
                                      <td><img src="{{asset('assets/images/'.$post->image)}}" alt="{{$post->title}}" width="100px"></td>
                                      <td>  <a href="javascript:void(0)" wire:click= "show_post({{$post->id}})">{{$post->title}}</a> </td>
                                      <td> {{$post->user->name}}</td>
                                      <td> {{$post->Category->name}}</td>
                                      <td> 
                                      <a href="javascript:void(0)" wire:click= "edit_post({{$post->id}})" class="btn btn-success btn-sm">edit</a>
                                      <a href="javascript:void(0)" wire:click= "delete_post({{$post->id}})" class="btn btn-danger btn-sm"
                                     onclick = "confirm('Are you sure ?'); return false;">Delete</a>
                                      </td>
                                    </tr>
                                @endforeach
                                </tbody>
                           </table>
                            
                            </div>
                            <div class="float-right">
                                {!!$posts->links() !!}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> 
    
    
    
    
</div>
