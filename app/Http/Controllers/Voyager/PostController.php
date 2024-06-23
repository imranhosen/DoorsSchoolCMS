<?php
namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Post;

class PostController extends VoyagerBaseController
{

    public function publish(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $post = Post::where('id', \request("id"))->first();
        $post->status = $post->status=="PENDING"?"PUBLISHED":"PENDING";
        $post->save();
        return redirect(route('voyager.posts.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $post = Post::findorfail($id);
        $post->forceDelete();

        return redirect(route('voyager.posts.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}
