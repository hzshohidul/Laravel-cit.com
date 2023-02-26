<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    //Tage page view
    function tag(){
        $tag_data_gola = Tag::all();
        return view('admin.tag.tag', [
            'tag_name_niyejaw' => $tag_data_gola,
        ]);
    }
    //Tag post item
    function tag_store(TagRequest $request){
        //Tag validate
        // $request->validate([
        //     'tag_name' => 'required|unique:tags',
        // ],[
        //     'tag_name.required' => 'Tag name ta daw.',
        //     'tag_name.unique' => 'Ai Tag name ta Databasee ase.',
        // ]);
        //Ai kaj gola amra request akta file make kore oikhane rakhlam.

        // //Tag Insert
        Tag::insert([
            'tag_name' => $request->tag_name,
        ]);
        return back()->withSuccesstag('Tag Inserted Successfully!');
    }
    //Tag Deleted
    function tag_delete($tag_del_idta){
        Tag::find($tag_del_idta)->delete();
        return back()->withDeletesuccess('Tag Deleted Succsully');
    }
}
