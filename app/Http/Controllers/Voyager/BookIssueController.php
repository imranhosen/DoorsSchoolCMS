<?php
namespace App\Http\Controllers\Voyager;

use App\Models\BookIssue;
use App\Models\ComplainType;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class BookIssueController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $book_issue = BookIssue::where('id', \request("id"))->first();
        $book_issue->status = $book_issue->status==1?0:1;
        $book_issue->save();
        return redirect(route('voyager.book-issues.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $book_issue = BookIssue::withTrashed()->findorfail($id);
        $book_issue->forceDelete();

        return redirect(route('voyager.book-issues.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


