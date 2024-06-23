<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Book;
use App\Models\BookIssue;
use App\Models\ComplainType;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Role;


class BookController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $book = Book::where('id', \request("id"))->first();
        $book->status = $book->status==1?0:1;
        $book->save();
        return redirect(route('voyager.books.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $book = Book::withTrashed()->findorfail($id);
        $book->forceDelete();

        return redirect(route('voyager.cbooks.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }
    public function issueBookByUser(){
        $user = Auth::user();
        $role_id = Role::where('name','Student')->value('id');
        if(($user->role_id) == $role_id){
            $books = BookIssue::where('student_id', $user->student_id)->get();
            return view('vendor.voyager.books.book_lists_by_user',compact('books'));
        }
        return view('vendor.voyager.books.book_lists_by_user',compact('books'));
    }

}


