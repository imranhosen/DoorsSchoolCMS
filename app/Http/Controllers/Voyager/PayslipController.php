<?php
namespace App\Http\Controllers\Voyager;

use App\Models\StaffPayslip;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class PayslipController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $staff_payslip = StaffPayslip::where('id', \request("id"))->first();
        $staff_payslip->status = $staff_payslip->status == 1 ? 0 : 1;
        $staff_payslip->save();
        return redirect(route('voyager.staff-payslip.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $staffPayslip = StaffPayslip::withTrashed()->findorfail($id);
        $staffPayslip->forceDelete();

        return redirect(route('voyager.staff-payslip.index'));

    }

}


