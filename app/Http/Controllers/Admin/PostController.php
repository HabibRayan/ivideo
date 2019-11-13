<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){
        $categories = Category::all();
        $posts = Post::all();
        return view('admin.post.index',[
            'categories' => $categories,
            'posts' => $posts,
        ]);

    }
    public function form(){
        $categories = Category::all();
        return view('admin.post.form',['categories' => $categories]);
    }

    public function getcategory(Request $request){

           $categoryId = $request->get('id');

           $subcategory = Subcategory::where('category_id', '=', $categoryId)->get();

            return response()->json($subcategory);
    }

    public function storePost(Request $request){

        $this->validate($request,[
            'title' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'video_link' => 'required',
            'tag' => 'required',
            'status' => 'required',
        ]);

       $id = $request->input('id');
       if ($id == ''){
           Post::create([
               'title' => $request->input('title'),
               'subcategory_id' => $request->input('subcategory'),
               'short_description' => $request->input('short_description'),
               'long_description' => $request->input('long_description'),
               'video_link' => $request->input('video_link'),
               'tag' => $request->input('tag'),
               'status' => $request->input('status'),
           ]);
       }elseif ($id !=""){
        $post = Post::find($id);
        $post->title = $request->title;
        $post->subcategory_id = $request->subcategory;
        $post->short_description = $request->short_description;
        $post->long_description = $request->long_description;
        $post->video_link = $request->video_link;
        $post->tag = $request->tag;
        $post->status = $request->status;
        $post->update();
       }

       return redirect(route('admin.post'));
    }



}
