<?php
namespace App\Http\Controllers\Voyager;

use App\Models\FeesDiscount;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class FeeDiscountController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $fee_discount = FeesDiscount::where('id', \request("id"))->first();
        $fee_discount->status = $fee_discount->status==1?0:1;
        $fee_discount->save();
        return redirect(route('voyager.fees-discounts.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }


    public function forceDelete($id)
    {

        $subject = FeesDiscount::withTrashed()->findorfail($id);
        $subject->forceDelete();

        return redirect(route('voyager.fees-discounts.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}


