<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\User;
Use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
   
    public function  __construct(){
        $this->middleware('auth');
    }


     
    public function index()
    {
        $posts = Post::with(['user','Category'])->OrderBy('id','desc')->paginate(PAGINATION_COUNT);
        return view('frontend.index',compact('posts'));
    }
    public function index_livewire()
    {
        return view('frontend.index_livewire');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catgories = Category::all(); 
        return view('frontend.create',compact('catgories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'  => 'required|max:255',
            'category' => 'required',
            'body'  => 'required',
            'image'  => 'nullable|mimes:jpg,jpeg,gif,png|max:20000',
        ]);
        if($validator->fails()){
           return redirect()->back()->withErrors($validator)->WithInput();
        }

        $data['title'] = $request->title;
        $data['category_id'] = $request->category;
        $data['body']  = $request->body;
        $data['user_id'] = auth()->id();

        if($image = $request->file('image')){
            $filename = Str::slug($request->title).'.' . $image->getClientOriginalExtension();
            $path = public_path('/assets/images/'.$filename);
            Image::make($image->getRealPath())->save($path,100);

            $data['image']  =$filename;

        }

        Post::create($data);
        return redirect()->route('posts.index')->with([
            'message' => 'post create successfully',
            'alert-type' => 'success'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::with(['user','category'])->whereId($id)->first();
        if($post){
            return view('frontend.show',compact('post'));
        }
      
        return redirect()->route('posts.index')->with([
            'message' => 'You have not permission to continue this process',
            'alert-type' => 'danger'
        ]);

    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::whereId($id)->first();
        if($post){
            $catgories = Category::all();
            return view('frontend.edit',compact('post','catgories'));
        }
      
        return redirect()->route('posts.index')->with([
            'message' => 'You have not permission to continue this process',
            'alert-type' => 'danger'
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(),[
            'title'          => 'required|max:255',
            'category'       => 'required',
            'body'           => 'required',
            'image'          => 'nullable|mimes:jpg,jpeg,gif,png|max:20000',
        ]);
        if($validator->fails()){
           return redirect()->back()->withErrors($validator)->WithInput();
        }
        $post = Post::whereId($id)->first();
        if($post){
        $data['title']              = $request->title;
        $data['category_id']        = $request->category;
        $data['body']               = $request->body;

        if($image = $request->file('image')){
            if(File::exists('assets/images/'.$post->image)){
                unlink('assets/images/'.$post->image);
            }

            $filename = Str::slug($request->title).'.' . $image->getClientOriginalExtension();
            $path = public_path('/assets/images/'.$filename);
            Image::make($image->getRealPath())->save($path,100);

            $data['image']  = $filename;

        }

       $post->update($data);
        return redirect()->route('posts.index')->with([
            'message' => 'post update successfully',
            'alert-type' => 'success'
        ]);
        }
        return redirect()->route('posts.index')->with([
            'message' => 'You have not permission to continue this process',
            'alert-type' => 'danger'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        
        $post = Post::whereId($id)->first();
        if($post){
       

        if($post->image != ''){
            if(File::exists('assets/images/'.$post->image)){
                unlink('assets/images/'.$post->image);
            }
        }

       $post->delete();
        return redirect()->route('posts.index')->with([
            'message' => 'post deleted successfully',
            'alert-type' => 'success'
        ]);
        }
        return redirect()->route('posts.index')->with([
            'message' => 'You have not permission to continue this process',
            'alert-type' => 'danger'
        ]);

    }
}
