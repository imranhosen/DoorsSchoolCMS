<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class StudentController extends VoyagerBaseController
{

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        //$session = Post::where('id', \request("id"))->first();
        $student = Student::where('id', \request("id"))->first();
        $student->status = $student->status==1?0:1;
        $student->save();
        return redirect(route('voyager.students.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $student = Student::withTrashed()->findorfail($id);
        if ($student->student_image != null) {
            $oldFileExists = Storage::disk('public')->exists($student->student_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($student->student_image);
            }
        }
        if ($student->father_image != null) {
            $oldFileExists = Storage::disk('public')->exists($student->father_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($student->father_image);
            }
        }
        if ($student->mother_image != null) {
            $oldFileExists = Storage::disk('public')->exists($student->mother_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($student->mother_image);
            }
        }
        if ($student->guardian_image != null) {
            $oldFileExists = Storage::disk('public')->exists($student->guardian_image);
            //dd($oldFileExists);
            if ($oldFileExists) {
                Storage::disk('public')->delete($student->guardian_image);
            }
        }
        $student->forceDelete();

        return redirect(route('voyager.students.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

