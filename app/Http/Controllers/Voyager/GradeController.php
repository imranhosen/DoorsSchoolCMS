<?php
namespace App\Http\Controllers\Voyager;

use App\Models\Grade;
use Illuminate\Http\Request;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class GradeController extends VoyagerBaseController
{
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();

        //match if same type exam has same value
        $exists = Grade::where('exam_type_id',$request->exam_type_id)
            ->where('percent_upto', '>=', $request->percent_from)
            ->where('percent_from', '<=', $request->percent_upto)
            ->orWhere(function ($query) use ($request) {
                $query->where('percent_from', '>=', $request->percent_from)
                    ->where('percent_upto', '<=', $request->percent_upto);
            })->exists();
        if($exists){
            return redirect()->route("voyager.{$dataType->slug}.index")->with(['message' => "Similar Exam Type couldn't have same percent !", 'alert-type' => 'error']);
        }
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());


        /*if(Grade::where('exam_type_id',$request->exam_type_id)->exists()){
            dd('hi');
        }*/

        event(new BreadDataAdded($dataType, $data));

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    public function active(){
        //Get post by id and toggle the status from PUBLISHED to PENDING and vice versa
        //$session = Post::where('id', \request("id"))->first();
        $grade = Grade::where('id', \request("id"))->first();
        $grade->status = $grade->status==1?0:1;
        $grade->save();
        return redirect(route('voyager.grades.index'))->with(['message' => "Status Updated Successfully !", 'alert-type' => 'success']);
    }
    public function forceDelete($id)
    {

        $grade = Grade::withTrashed()->findorfail($id);
        $grade->forceDelete();
        return redirect(route('voyager.grades.index'))->with(['message' => "Permanently Deleted Successfully !", 'alert-type' => 'error']);

    }

}

