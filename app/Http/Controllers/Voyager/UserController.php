<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\FrontBannerImage;
use App\Models\FrontCmsPage;
use App\Models\StudentFee;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\User;


class UserController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $user = User::where('id', \request("id"))->first();
        $user->status = $user->status==1?0:1;
        $user->save();
        return redirect(route('voyager.users.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $user = User::findorfail($id);
        $user->forceDelete();

        return redirect(route('voyager.users.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


