<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Str;
use Image;

class CategoryController extends Controller
{
    function category(){
        $all_category = Category::all();
        return view('admin.category.category', [
            'categorygola' => $all_category,
        ]);
    }
    function category_store(Request $request){
        //Category Image validate
        $request->validate([
            'category_name' => 'required|unique:categories', //categories name ta holo table ar nam
            'category_image' => 'required',
            'category_image' => 'mimes:png,jpg',
            'category_image' => 'file|max:20000',
        ]);
        //Category Name Insert
        $provite_cat_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'created_at'    => Carbon::now(),
        ]);
        //Category Image Insert
        $uploaded_file = $request->category_image;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ', '-', $request->category_name)).'-'.rand(100000,999999).'.'.$extension;

        Image::make($uploaded_file)->resize(250, 200)->save(public_path('/uploads/category/'.$file_name));

        Category::find($provite_cat_id)->update([
            'category_image' => $file_name,
        ]);
        //----------------------
        return back()->withSuccess('Category Inserted Succuss');
    }
    //category Delete
    function category_delete($cat_del_idta){

        $cat_image_select = Category::where('id', $cat_del_idta)->first()->category_image;
        $image_location = public_path('uploads/category/'.$cat_image_select);
        unlink($image_location);

        Category::find($cat_del_idta)->delete();
        return back()->withSuccessdelete('Category Deleted Successfully!');
    }
    //Category Edit
    function category_edit($cat_edit_idta){
        $category_dateata = Category::find($cat_edit_idta);
        return view('admin.category.edit', [
            'cat_data_gola' => $category_dateata,
        ]);
    }
    //Category Update
    function category_update(Request $request){
        if($request->category_image == ''){
            Category::find($request->cat_hidden_idta)->update([
                'category_name' => $request->category_name,
            ]);
        }else{
            //previous Image Deleted
            $cat_image_select = Category::where('id', $request->cat_hidden_idta)->first()->category_image;
            $image_location = public_path('uploads/category/'.$cat_image_select);
            unlink($image_location);

            //Category Image Insert
            $uploaded_file = $request->category_image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Str::lower(str_replace(' ', '-', $request->category_name)).'-'.rand(100000,999999).'.'.$extension;

            Image::make($uploaded_file)->resize(250, 200)->save(public_path('/uploads/category/'.$file_name));

            //Insert date
            Category::find($request->cat_hidden_idta)->update([
                'category_name' => $request->category_name,
                'category_image' => $file_name,
            ]);
            return back()->withSuccess('Category Updated Succussfuly');
        }

    }
}
