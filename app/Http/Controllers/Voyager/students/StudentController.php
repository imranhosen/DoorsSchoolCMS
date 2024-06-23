<?php

namespace App\Http\Controllers\Voyager\students;

use App\Http\Controllers\Controller;
use App\Models\Clase;
use App\Models\Section;
use App\Models\Session;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Role;

class StudentController extends VoyagerBaseController
{
    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $classes = Clase::where('status', 1)->get();
        $sessions = Session::where('status', 1)->get();
        $sections = Section::where('status', 1)->get();

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'add', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable','classes','sessions','sections'));
    }
    public function edit(Request $request, $id)
    {
        $classes = Clase::where('status', 1)->get();
        $sessions = Session::where('status', 1)->get();
        $sections = Section::where('status', 1)->get();

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable','classes','sessions','sections'));
    }
    public function store(Request $request)
    {
        if($request->email){
            $this->validate($request, [
                'email' => 'email|unique:students'
            ]);
        }
        //dd($request->all());
       /* if ($request->mobile_number ) {
            if (!is_numeric($request->mobile_number )) {
                Toastr::error('Student Phone number field must be Numeric value', 'error');
                return back();
            }
        }
        if ($request->father_number ) {
            if (!is_numeric($request->father_number )) {
                Toastr::error('Father Phone number field must be Numeric value', 'error');
                return back();
            }
        }
        if ($request->mother_number ) {
            if (!is_numeric($request->mother_number )) {
                Toastr::error('Mother Phone number field must be Numeric value', 'error');
                return back();
            }
        }
        if ($request->guardian_number ) {
            if (!is_numeric($request->guardian_number )) {
                Toastr::error('Guardian Phone number field must be Numeric value', 'error');
                return back();
            }
        }*/
        $this->validate($request, [
            'mobile_number' => 'numeric|regex:/(01)[0-9]{9}/|unique:students',
            'father_number' => 'numeric|regex:/(01)[0-9]{9}/',
            'guardian_number' => 'numeric|regex:/(01)[0-9]{9}/'
        ]);
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        //dd($data);

        //create user
        if($request->email){
            $role_id = Role::where('name','Student')->value('id');
            $last_id = DB::table('students')->orderBy('id','DESC')->value('id');

            $user = new User();
            $user->name = $request->first_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->mobile_number);
            $user->role_id = $role_id;
            $user->student_id = $data->id;
            $user->save();
        }else{
            $number = $request->mobile_number;
            $last_three_digit = substr($number, -3);
            $mail = "@gmail.com";
            $role_id = Role::where('name','Student')->value('id');
            $last_id = DB::table('students')->orderBy('id','DESC')->value('id');

            $user = new User();
            $user->name = $request->first_name;
            $user->email = strtolower($request->first_name).$last_three_digit.$mail;
            $user->password = Hash::make($request->mobile_number);
            $user->role_id = $role_id;
            $user->student_id = $data->id;
            $user->save();
        }
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
    public function update(Request $request, $id)
    {
        //dd($id);
        $this->validate($request, [
            'mobile_number' => 'numeric|regex:/(01)[0-9]{9}/',
            'father_number' => 'numeric|regex:/(01)[0-9]{9}/',
            'guardian_number' => 'numeric|regex:/(01)[0-9]{9}/'
        ]);
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        $query = $model->query();
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $query = $query->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $query = $query->withTrashed();
        }

        $data = $query->findOrFail($id);

        // Check permission
        $this->authorize('edit', $data);

        if(!(User::where('student_id', $id)->exists())){
            if($request->email){
                $role_id = Role::where('name','Student')->value('id');
                $last_id = DB::table('students')->orderBy('id','DESC')->value('id');

                $user = new User();
                $user->name = $request->first_name;
                $user->email = $request->email;
                $user->password = Hash::make($request->mobile_number);
                $user->role_id = $role_id;
                $user->student_id = $id;
                $user->save();
            }else{
                $number = $request->mobile_number;
                $last_three_digit = substr($number, -3);
                $mail = "@gmail.com";
                $role_id = Role::where('name','Student')->value('id');
                $last_id = DB::table('students')->orderBy('id','DESC')->value('id');

                $user = new User();
                $user->name = $request->first_name;
                $user->email = strtolower($request->first_name).$last_three_digit.$mail;
                $user->password = Hash::make($request->mobile_number);
                $user->role_id = $role_id;
                $user->student_id = $id;
                $user->save();
            }
        }

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();

        // Get fields with images to remove before updating and make a copy of $data
        $to_remove = $dataType->editRows->where('type', 'image')
            ->filter(function ($item, $key) use ($request) {
                return $request->hasFile($item->field);
            });
        $original_data = clone($data);

        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        //create user
     /* $number = $request->mobile_number;
        $last_three_digit = substr($number, -3);
        $mail = "@gmail.com";
        $role = Role::where('name','Student')->value('id');
        $user =  User::where('student_id',$id);
        $user->delete();

        $user = new User();
        $user->name = $request->first_name;
        $user->email = strtolower($request->first_name).$last_three_digit.$mail;
        $user->password = Hash::make($request->mobile_number);
        $user->role_id = $role;
        $user->student_id = $id;
        $user->save();*/

        // Delete Images
        $this->deleteBreadImages($original_data, $to_remove);

        event(new BreadDataUpdated($dataType, $data));

        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }

        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated')." {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }
}
