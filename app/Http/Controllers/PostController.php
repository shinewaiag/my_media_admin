<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct post page
    public function index() {
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.index', compact('category', 'post'));
    }

    //create post
    public function createPost(Request $request) {
        $this->postValidationCheck($request);

        if(!empty($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage', $fileName);

            $data = $this->getPostData($request, $fileName);
        }else {
            $data = $this->getPostData($request, null);
        }

        Post::create($data);
        return back();
    }

    //delete post
    public function deletePost($id) {
        $postData = Post::where('post_id', $id)->first();
        $dbImageName = $postData->image;
        Post::where('post_id', $id)->delete();
        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
        return back()->with(['deleteSuccess' => 'Post deleted successfully']);
    }

    //redirect edit Post page
    public function editPost($id) {
        $postDetails = Post::where('post_id', $id)->first();
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.edit', compact('postDetails', 'category', 'post'));
    }

    //update Post
    public function updatePost($id, Request $request) {
        $this->postValidationCheck($request);
        $data = $this->getUpdateData($request);
        if(isset($request->postImage)) {
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $data['image'] = $fileName;

            //get image name from database
            $postData = Post::where('post_id', $id)->first();
            $dbImageName = $postData->image;

            //delete image from public folder
            if(File::exists(public_path().'/postImage/'.$dbImageName)){
                File::delete(public_path().'/postImage/'.$dbImageName);
            }

            //store new image in public folder
            $file->move(public_path().'/postImage', $fileName);

            //update new data
            Post::where('post_id', $id)->update($data);
        }else {
            Post::where('post_id', $id)->update($data);
        }
        return back();
    }

    //get update post data
    public function getUpdateData($request) {
        return [
            'title' => $request->postTitle,
            'description' => $request->desc,
            'category_id' => $request->categoryName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    private function getPostData($request, $fileName) {
        return [
            'title' => $request->postTitle,
            'description' => $request->desc,
            'image' => $fileName,
            'category_id' => $request->categoryName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    //post validation check
    private function postValidationCheck($request) {
        Validator::make($request->all(),[
            'postTitle' => 'required',
            'desc' => 'required',
            'categoryName' => 'required',
        ])->validate();
    }
}
