<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use Str;
use Auth;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Post Page view
    function add_post(){
        $category_gola = Category::all();
        $tag_gola = Tag::all();
        return view('admin.post.add_post',[
            'categories_gola' => $category_gola,
            'tags_gola' => $tag_gola,
        ]);
    }
    // Post Store
    function post_store(Request $request){
        $after_emplode_tag = implode(',', $request->tag_idta);
        $total_post_ta = Post::insertGetId([
            'author_id'    => Auth::id(),
            'category_id'  => $request->category_idta,
            'title'        => $request->title,
            'short_desp'   => $request->short_desp,
            'desp'         => $request->desp,
            'tag_id'       => $after_emplode_tag,
            'feat_image'   => $request->feat_image,
            'slug'         => Str::lower(str_replace(' ', '-', $request->title)).'-'.rand(1000000000, 9999999999),
            'created_at'   => Carbon::now(),
        ]);

        // Folder Upload Image with new create name
        $uploaded_image = $request->feat_image;
        $img_extention = $uploaded_image->getClientOriginalExtension();
        $image_name = Str::lower(str_replace(' ', '-', Auth::user()->name)).'-post-'.rand(1000000000, 9999999999).'.'.$img_extention;

        $upload_image_folder = Image::make($uploaded_image)->save(public_path('uploads/post/'.$image_name));

        //Database Image name Update kore deya
        $update = Post::find($total_post_ta)->update([
            'feat_image' => $image_name,
        ]);
        return back()->with('post_insert_success', 'New Post Inserted Successfully.');
    }
    // My Post Page view
    function my_post(){
        $my_post_gola = Post::where('author_id', Auth::id())->get();
        return view('admin.post.post', [
            'my_post_gola' => $my_post_gola,
        ]);
    }
    //All Post Page view
    function all_post(){
        $all_post_gola = Post::all();
        return view('admin.post.all_post', [
            'my_post_gola' => $all_post_gola,
        ]);
    }
    // Single Post View (Page view)
    function post_view($post_idta){
        $post_ta = Post::find($post_idta);
        return view('admin.post.view_post', [
            'post_ta' => $post_ta,
        ]);
    }
    // Post Delete
    function post_delete($post_idta){
        $post_imageta = Post::find($post_idta);
        $image_delete_folder = public_path('uploads/post/'.$post_imageta->feat_image);
        if($post_imageta->feat_image == null){
            Post::find($post_idta)->delete();
            return back()->with('post_delectttt', 'Post Delected.');
        }else{
            unlink($image_delete_folder);
            Post::find($post_idta)->delete();
            return back()->with('post_delect', 'Post Delected Successfully.');
        }
    }
    // Post Edit Page view
    function post_edit($post_idta){
        $category_gola = Category::all();
        $tag_gola = Tag::all();
        $postta = Post::find($post_idta);
        return view('admin.post.edit', [
            'category_gola' => $category_gola,
            'tag_gola' => $tag_gola,
            'postta' => $postta,
        ]);
    }
    // Post Update
    function post_update(Request $request){
        $after_emplode_tagss = implode(',', $request->tag_idta);
        if($request->feat_image == ''){
            //Update Post
            Post::find($request->post_hidden_id)->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'tag_id' => $after_emplode_tagss,
                'short_desp' => $request->short_desh,
                'desp' => $request->desp,
            ]);
            return back()->with('post_update', 'Post Updated Successfully.');
        }else{
            //Folder image deleted
            $post_imageta = Post::find($request->post_hidden_id);
            $image_delete_folder = public_path('uploads/post/'.$post_imageta->feat_image);
            unlink($image_delete_folder);

            // New Image Upload Folder with new create name
            $uploaded_image = $request->feat_image;
            $img_extention = $uploaded_image->getClientOriginalExtension();
            $image_name = Str::lower(str_replace(' ', '-', Auth::user()->name)).'-post-'.rand(1000000000, 9999999999).'.'.$img_extention;

            $upload_image_folder = Image::make($uploaded_image)->save(public_path('uploads/post/'.$image_name));

            //Update Post
            Post::find($request->post_hidden_id)->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'tag_id' => $after_emplode_tagss,
                'short_desp' => $request->short_desh,
                'desp' => $request->desp,
                'feat_image' => $image_name,
            ]);
            return back()->with('post_update', 'Post Updated Successfully.');
        }
    }
}
