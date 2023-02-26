<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Frontend index page view with data fas
    function welcome(){
        $slider_post_gola = Post::latest('created_at')->take(3)->get();
        $recent_post_gola = Post::latest('created_at')->paginate(3);
        $category_gola = Category::all();
        $tag_gola = Tag::all();
        return view('frontend.index', [
            'slider_post_gola' => $slider_post_gola,
            'recent_post_gola' => $recent_post_gola,
            'category_gola'    => $category_gola,
            'tag_gola'         => $tag_gola,
        ]);
    }
    //category post page view
    function category_post($category_idta){
        $category_post_gola = Post::where('category_id', $category_idta)->get();
        $category_info = Category::find($category_idta);
        return view('frontend.category_post',[
            'category_post_gola' => $category_post_gola,
            'category_info' => $category_info,
        ]);
    }
    //Author Post Page view
    function author_post($author_idta){
        $author_post_gola = Post::where('author_id', $author_idta)->get();
        $author_info      = User::find($author_idta);
        $tag_gola         = Tag::all();
        $category_gola    = Category::all();
        return view('frontend.author_post',[
          'author_post_gola' => $author_post_gola,
          'author_info'      => $author_info,
          'tag_gola'         => $tag_gola,
          'category_gola'    => $category_gola,
        ]);
    }
    //Author List Page view
    function author_list(){
        $author_list = Post::select('author_id')
        ->groupBy('author_id')
        ->selectRaw('author_id, sum(author_id) as sum')
        ->get();
        return view('frontend.author_list',[
            'author_list' => $author_list,
        ]);
    }
    //Post Details Page view
    function post_details($slug){
        $post_details = Post::where('slug', $slug)->get();
        return view('frontend.post_details',[
            'post_details' => $post_details,
        ]);
    }
}
