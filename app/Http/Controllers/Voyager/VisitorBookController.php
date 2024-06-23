<?php
namespace App\Http\Controllers\Voyager;

use App\Models\VisitorBook;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class VisitorBookController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $visitor_book = VisitorBook::where('id', \request("id"))->first();
        $visitor_book->status = $visitor_book->status==1?0:1;
        $visitor_book->save();
        return redirect(route('voyager.visitor-books.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $visitor_book = VisitorBook::withTrashed()->findorfail($id);
        $visitor_book->forceDelete();

        return redirect(route('voyager.visitor-books.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


