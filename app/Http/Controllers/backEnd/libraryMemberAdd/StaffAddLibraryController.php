<?php
namespace App\Http\Controllers\backEnd\libraryMemberAdd;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;


class StaffAddLibraryController extends Controller
{

    public function index(Request $request){
        $this->authorize('browse_staff-add-library');
        $staffs = Staff::where('status', 1)->get();
        return view('backend.library.staff-library-card-add-index',compact('staffs'));
    }
    public function fetchStaffLibraryNumber(Staff $staffId)
    {
        return response()->json(['staff'=>$staffId]);
    }
    public function updateStaffLibraryCard(Request $request)
    {
        //dd($request->all());

        if (!empty($request->library_card_no)) {
            $staff = Staff::find($request->staff_id);
            $staff->library_id = $request->library_card_no;
            $staff->update();
            return redirect()->back()->with('message', 'Staff Add as a Library Member Successfully');
        } else {
            $staff = Staff::find($request->staff_id);
            $staff->library_id = $request->library_card_no;
            $staff->update();
            return redirect()->back()->with(['message' => 'Staff Membership Removed Successfully !','alert-type'=>'error']);
        }
    }
    public function edit(Staff $staff){
        return view('staffAddLibrary.addLibraryCard',compact('staff'));
    }


}


