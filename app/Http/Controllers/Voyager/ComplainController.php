<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Complain;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use function Laminas\Diactoros\getClientFilename;
use function League\Flysystem\delete;


class ComplainController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $complain = Complain::where('id', \request("id"))->first();
        $complain->status = $complain->status==1?0:1;
        $complain->save();
        return redirect(route('voyager.complains.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {
        $complain = Complain::withTrashed()->findorfail($id);
        /*if($complain->file != null){
           //$dlt =  File::delete(public_path($complain->file));
           //unset public_path($complain->file);
           //File::delete($dlt);
           //dd($dlt);
        }*/
       /* if ($complain->file != null) {
            $oldFileExists = Storage::disk('public')->exists($complain->file);
            dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($complain->file);
            }
        }*/
        $complain->forceDelete();
        return redirect(route('voyager.complains.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


