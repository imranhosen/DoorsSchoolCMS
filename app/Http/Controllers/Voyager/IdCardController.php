<?php
namespace App\Http\Controllers\Voyager;

use App\Models\ComplainType;
use App\Models\IdCard;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class IdCardController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $id_card = IdCard::where('id', \request("id"))->first();
        $id_card->status = $id_card->status==1?0:1;
        $id_card->save();
        return redirect(route('voyager.id-cards.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $id_card = IdCard::withTrashed()->findorfail($id);
        if ($id_card->background != null) {
            $oldFileExists = Storage::disk('public')->exists($id_card->background);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($id_card->background);
            }
        }
        if ($id_card->logo != null) {
            $oldFileExists = Storage::disk('public')->exists($id_card->logo);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($id_card->logo);
            }
        }
        if ($id_card->sign_image != null) {
            $oldFileExists = Storage::disk('public')->exists($id_card->sign_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($id_card->sign_image);
            }
        }
        $id_card->forceDelete();

        return redirect(route('voyager.id-cards.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


