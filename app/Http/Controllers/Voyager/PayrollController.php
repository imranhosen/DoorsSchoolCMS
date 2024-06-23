<?php
namespace App\Http\Controllers\Voyager;

use App\Models\StaffPayroll;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class PayrollController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        $staff_payroll = StaffPayroll::where('id', \request("id"))->first();
        $staff_payroll->status = $staff_payroll->status == 1 ? 0 : 1;
        $staff_payroll->save();
        return redirect(route('voyager.staff-payroll.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $staffPayroll = StaffPayroll::withTrashed()->findorfail($id);
        $staffPayroll->forceDelete();

        return redirect(route('voyager.staff-payroll.index'));

    }

}


