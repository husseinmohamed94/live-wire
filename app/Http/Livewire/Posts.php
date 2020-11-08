<?php

namespace App\Http\Livewire;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    
    public function render()
    {
        $posts = Post::with(['user','Category'])->OrderBy('id','desc')->paginate(PAGINATION_COUNT);

        return view('livewire.posts',[
            'posts' => $posts
        ]);
    }

    public function create_post(){

    }
  public function show_post(){
        
    }

    public function edit_post($id){
        
    }

    public function delete_post($id){
        
    }

}
