@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="fa-solid fa-user-group"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <!-- form start -->
    <form role="form"
          class="form-edit-add"
          action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
          method="POST" enctype="multipart/form-data">
        <!-- PUT Method if we are editing -->
    @if($edit)
        {{ method_field("PUT") }}
    @endif

    <!-- CSRF TOKEN -->
        {{ csrf_field() }}
        <div class="page-content edit-add container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                        <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp
                            <div class="around10">
                                <input type="hidden" name="ci_csrf_token" value=""> <input type="hidden"
                                                                                           name="sibling_name"
                                                                                           value=""
                                                                                           id="sibling_name_next">
                                <input type="hidden" name="sibling_id" value="0" id="sibling_id">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Admission Number</label> <small
                                                class="req"> *</small>
                                            <input autofocus="" id="admission_no" readonly="true"
                                                   name="admission_no" placeholder="Auto Generate" type="text"
                                                   class="form-control" value="" autocomplete="off">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="roll_number" class="bold">Roll Number</label>
                                            <input id="roll_number" name="roll_number" value="{{ old('roll_number', $dataTypeContent->roll_number ?? '') }}" type="text"
                                                   class="form-control">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Class</label><small class="req">
                                                *</small>
                                            <select id="class-dropdown" name="class_id" class="form-control required" >
                                                <option value=" ">Select</option>
                                                @foreach($classes as $class)
                                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('class_id')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Group</label>
                                            <select id="group-dropdown" name="group_id" value="{{ old('group_id', $dataTypeContent->group_id ?? '') }}" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">First Name</label><small class="req">
                                                *</small>
                                            <input id="first_name" name="first_name" type="text" value="{{ old('first_name', $dataTypeContent->first_name ?? '') }}"
                                                   class="form-control">
                                            <span class="text-danger">{{$errors->first('first_name')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Last Name</label>
                                            <input id="last_name" name="last_name" value="{{ old('last_name', $dataTypeContent->last_name ?? '') }}" type="text"
                                                   class="form-control">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputFile" class="bold"> Gender</label><small class="req">
                                                *</small>
                                            <select class="form-control" name="gender">
                                                <option value="">Select</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                <option value="2">Others</option>
                                            </select>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Date Of Birth</label><small class="req">
                                                *</small>
                                            <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', $dataTypeContent->birth_date ?? '') }}"
                                                   class="form-control">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Religion</label>
                                            <input id="religion" name="religion" type="text"  value="{{ old('religion', $dataTypeContent->religion ?? '') }}"
                                                   class="form-control">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Caste</label><small class="req">
                                                *</small>
                                            <input id="caste" name="caste" type="text" value="{{ old('caste', $dataTypeContent->caste ?? '') }}"
                                                   class="form-control">
                                           <span class="text-danger">{{$errors->first('caste')}}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Mobile Number</label>
                                            <input id="mobile_number" name="mobile_number" type="number" value="{{ old('mobile_number', $dataTypeContent->mobile_number ?? '') }}"
                                                   class="form-control">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Email</label>
                                            <input id="email" name="email" type="text" value="{{ old('email', $dataTypeContent->email ?? '') }}"
                                                   class="form-control">
                                            <span class="text-danger">{{$errors->first('email')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleInputFile" class="bold">Student Photo</label>
                                        @if(isset($dataTypeContent->student_image))
                                            <img
                                                src="{{ filter_var($dataTypeContent->student_image, FILTER_VALIDATE_URL) ? $dataTypeContent->student_image : Voyager::image( $dataTypeContent->student_image ) }}"
                                                style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;"/>
                                        @endif
                                        <input type="file" data-name="student_image" name="student_image">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Admission Date</label>
                                            <input id="admission_date" name="admission_date"
                                                   value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                                   type="date" class="form-control" readonly="readonly">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Blood Group</label>
                                            <select class="form-control" name="blood_group">
                                                <option value="">Select</option>
                                                <option value="O+">O+</option>

                                                <option value="A+">A+</option>

                                                <option value="B+">B+</option>

                                                <option value="AB+">AB+</option>

                                                <option value="O-">O-</option>

                                                <option value="A-">A-</option>

                                                <option value="B-">B-</option>

                                                <option value="AB-">AB-</option>

                                            </select>

                                            <span class="text-danger"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Height</label>
                                            <input type="text" name="height" class="form-control" value="{{ old('height', $dataTypeContent->height ?? '') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Weight</label>
                                            <input type="text" name="weight" class="form-control" value="{{ old('weight', $dataTypeContent->weight ?? '') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">As on Date</label>
                                            <input type="date" id="measurement_date"
                                                   value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                                   name="measurement_date" class="form-control">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Session</label>
                                            <select id="session_id" name="session_id" class="form-control">
                                                <option value=" ">Select</option>
                                                @foreach($sessions as $session)
                                                    <option value="{{$session->id}}">{{$session->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="bold">Section</label>
                                            <select id="section_id" name="section_id" class="form-control">
                                                <option value=" ">Select</option>
                                                @foreach($sections as $section)
                                                    <option value="{{$section->id}}">{{$section->section}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="page-content edit-add container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <h4 class="bold"><i class="fa-solid fa-circle-info"></i> Parent Guardian Details</h4>
                            <hr/>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="father_name" class="bold">Father Name</label>
                                            <input id="father_name" name="father_name"
                                                   type="text" class="form-control" value="{{ old('father_name', $dataTypeContent->father_name ?? '') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="father_number" class="bold">Father Phone</label>
                                            <input id="father_number" name="father_number"
                                                   type="number" class="form-control" value="{{ old('father_number', $dataTypeContent->father_number ?? '') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="father_occupation" class="bold">Father Occupation</label>
                                            <input id="father_occupation" name="father_occupation"
                                                   type="text" class="form-control" value="{{ old('father_occupation', $dataTypeContent->father_occupation ?? '') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="father_image" class="bold">Father Photo</label>
                                        @if(isset($dataTypeContent->father_image))
                                            <img
                                                src="{{ filter_var($dataTypeContent->father_image, FILTER_VALIDATE_URL) ? $dataTypeContent->father_image : Voyager::image( $dataTypeContent->father_image ) }}"
                                                style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;"/>
                                        @endif
                                        <input type="file" data-name="father_image" name="father_image">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mother_name" class="bold">Mother Name</label>
                                            <input id="mother_name" name="mother_name"
                                                   type="text" class="form-control" value="{{ old('mother_name', $dataTypeContent->mother_name ?? '') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mother_number" class="bold">Mother Phone</label>
                                            <input id="mother_number" name="mother_number"
                                                   placeholder=""
                                                   type="number" class="form-control" value="{{ old('mother_number', $dataTypeContent->mother_number ?? '') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mother_occupation" class="bold">Mother Occupation</label>
                                            <input id="mother_occupation" name="mother_occupation"
                                                   placeholder="" type="text" class="form-control"
                                                   value="{{ old('mother_occupation', $dataTypeContent->mother_occupation ?? '') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="father_image" class="bold">Mother Photo</label>
                                        @if(isset($dataTypeContent->mother_image))
                                            <img
                                                src="{{ filter_var($dataTypeContent->mother_image, FILTER_VALIDATE_URL) ? $dataTypeContent->mother_image : Voyager::image( $dataTypeContent->mother_image ) }}"
                                                style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;"/>
                                        @endif
                                        <input type="file" data-name="mother_image" name="mother_image">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="bold">If Guardian Is<small class="req"> *</small>&nbsp;&nbsp;&nbsp;</label>
                                        <label class="radio-inline" class="bold">
                                            <input type="radio" name="guardian_is" value="father">
                                            Father
                                        </label>
                                        <label class="radio-inline" class="bold">
                                            <input type="radio" name="guardian_is" value="mother">
                                            Mother
                                        </label>
                                        <label class="radio-inline" class="bold">
                                            <input type="radio" name="guardian_is" value="other"> Other
                                        </label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="guardian_name" class="bold">Guardian Name</label>
                                                    <small class="req"> *</small>
                                                    <input id="guardian_name" name="guardian_name"
                                                           type="text" class="form-control" value="{{ old('guardian_name', $dataTypeContent->guardian_name ?? '') }}">
                                                    <span class="text-danger">{{$errors->first('guardian_name')}}</span>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="guardian_relation" class="bold">Guardian
                                                        Relation</label><small class="req"> *</small>
                                                    <input id="guardian_relation"
                                                           name="guardian_relation"
                                                           type="text" class="form-control" value="{{ old('guardian_relation', $dataTypeContent->guardian_relation ?? '') }}">
                                                    <span class="text-danger">{{$errors->first('guardian_relation')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="guardian_number" class="bold">Guardian
                                                        Phone</label><small class="req"> *</small>
                                                    <input id="guardian_number" name="guardian_number"
                                                           type="number" class="form-control" value="{{ old('guardian_number', $dataTypeContent->guardian_number ?? '') }}">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="guardian_occupation" class="bold">Guardian
                                                        Occupation</label>
                                                    <input id="guardian_occupation"
                                                           name="guardian_occupation"
                                                           type="text" class="form-control" value="{{ old('guardian_occupation', $dataTypeContent->guardian_occupation ?? '') }}">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="guardian_email" class="bold">Guardian Email</label>
                                            <input id="guardian_email" name="guardian_email"
                                                   type="text" class="form-control" value="{{ old('guardian_email', $dataTypeContent->guardian_email ?? '') }}">
                                            <span class="text-danger"></span>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <label for="father_image" class="bold">Guardian Photo</label>
                                        @if(isset($dataTypeContent->guardian_image))
                                            <img
                                                src="{{ filter_var($dataTypeContent->guardian_image, FILTER_VALIDATE_URL) ? $dataTypeContent->guardian_image : Voyager::image( $dataTypeContent->guardian_image ) }}"
                                                style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;"/>
                                        @endif
                                        <input type="file" data-name="guardian_image"
                                               name="guardian_image">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="guardian_address" class="bold">Guardian Address</label>
                                        <textarea id="guardian_address" name="guardian_address"
                                                  class="form-control" rows="2" value="{{ old('guardian_address', $dataTypeContent->guardian_address ?? '') }}"></textarea>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content edit-add container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                            <div class="panel-body">
                                <div class="box-header with-border">
                                    <a id="addMoreDetails" data-toggle="collapse" data-target="#addMoreDetailsDiv">
                                        <i class="fa fa-fw fa-plus"></i>Add More Details</a>
                                </div>
                                <div class="box-body collapse" id="addMoreDetailsDiv">
                                    <div class="tshadow mb25 bozero">
                                        <h4 class="bold"><i class="fa-solid fa-location-dot"></i> Student Address Details</h4>
                                        <hr/>
                                        <div class="row around10">
                                            <div class="col-md-6">
                                                <div class="checkbox bold">
                                                    <label class="bold">
                                                        <input type="checkbox"
                                                               id="autofill_current_address"
                                                               onclick="return auto_fill_guardian_address();">
                                                        If Guardian Address is Current Address </label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="current_address" class="bold">Current Address</label>
                                                    <textarea id="current_address"
                                                              name="current_address"
                                                              class="form-control" value="{{ old('current_address', $dataTypeContent->current_address ?? '') }}"></textarea>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkbox bold">
                                                    <label class="bold">
                                                        <input type="checkbox" id="autofill_address"
                                                               onclick="return auto_fill_address();">
                                                        If Permanent Address is Current Address </label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="parmanent_address" class="bold">Permanent
                                                        Address</label>
                                                    <textarea id="parmanent_address"
                                                              name="parmanent_address" placeholder=""
                                                              class="form-control" value="{{ old('parmanent_address', $dataTypeContent->parmanent_address ?? '') }}"></textarea>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tshadow mb25 bozero">
                                        <h4 class="bold"><i class="fa-sharp fa-solid fa-bus-simple"></i> Transport Details </h4>
                                        <hr/>
                                        <div class="row around10">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="bold">Route List</label>
                                                    <select class="form-control" id="vehroute_id"
                                                            name="vehroute_id" value="{{ old('vehroute_id', $dataTypeContent->vehroute_id ?? '') }}">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tshadow mb25 bozero">
                                        <h4 class="bold"><i class="fa-sharp fa-solid fa-hotel"></i> Hostel Details
                                        </h4>
                                        <hr/>
                                        <div class="row around10">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="bold">Hostel</label>

                                                    <select class="form-control" id="hostel_room_id"
                                                            name="hostel_room_id">

                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="bold">Room Number</label>
                                                    <select id="hostel_room_id" name="hostel_room_id"
                                                            class="form-control">
                                                        <option value="">Select</option>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tshadow mb25 bozero">
                                        <h4 class="bold"><i class="fa-sharp fa-solid fa-bars"></i> Miscellaneous Details </h4>
                                        <hr/>
                                        <div class="row around10">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="bankAccount_number" class="bold">Bank Account
                                                        Number</label>
                                                    <input id="bankAccount_number"
                                                           name="bankAccount_number" type="text"
                                                           class="form-control" value="{{ old('bankAccount_number', $dataTypeContent->bankAccount_number ?? '') }}">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="bank_name" class="bold">Bank Name</label>
                                                    <input id="bank_name" name="bank_name" type="text"
                                                           class="form-control" value="{{ old('bank_name', $dataTypeContent->bank_name ?? '') }}">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ifsc_code" class="bold">IFSC Code</label>
                                                    <input id="ifsc_code" name="ifsc_code" type="text"
                                                           class="form-control" value="{{ old('ifsc_code', $dataTypeContent->ifsc_code ?? '') }}">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row around10">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="national_id" class="bold">
                                                        National Identification Number</label>
                                                    <input id="national_id" name="national_id"
                                                           type="text" class="form-control" value="{{ old('national_id', $dataTypeContent->national_id ?? '') }}">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="local_id" class="bold">
                                                        Local Identification Number </label>
                                                    <input id="local_id" name="local_id" type="text"
                                                           class="form-control" value="{{ old('local_id', $dataTypeContent->local_id ?? '') }}">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="bold">RTE</label>
                                                <div class="radio" style="margin-top: 2px;">
                                                    <label><input class="radio-inline" type="radio"
                                                                  name="rte" value="1">Yes</label>
                                                    <label><input class="radio-inline" checked="checked"
                                                                  type="radio" name="rte"
                                                                  value="0">No</label>
                                                </div>
                                                <span class="text-danger">{{$errors->first('rte')}}</span>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="previousCollege_details" class="bold">Previous
                                                        College Details</label>
                                                    <textarea class="form-control" rows="3"
                                                              name="previousCollege_details" value="{{ old('previousCollege_details', $dataTypeContent->previousCollege_details ?? '') }}"></textarea>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="note" class="bold">Note</label>
                                                    <textarea class="form-control" rows="3"
                                                              name="note" value="{{ old('note', $dataTypeContent->note ?? '') }}"></textarea>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer" style="margin-left: 6px">
                                @section('submit-buttons')
                                    <button type="submit"
                                            class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                                @stop
                                @yield('submit-buttons')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>



    <!-- panel-body -->

    <div style="display:none">
        <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
        <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                    </h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'
                    </h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger"
                            id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>

        $(document).ready(function () {
            /*$('#addMoreDetails').on('click', function () {
                $('#addMoreDetailsDiv').show();
                $('#addMoreDetails').on('click', function (){
                    $('#addMoreDetailsDiv').hide();
                });
            });*/

           /* function auto_fill_guardian_address() {

                if ($("#autofill_current_address").is(':checked'))
                {
                    //alert('hi');
                    $('#current_address').val($('#guardian_address').val());
                }
            }
            function auto_fill_address() {
                if ($("#autofill_address").is(':checked'))
                {
                    $('#permanent_address').val($('#current_address').val());
                }
            }*/
            $('input:radio[name="guardian_is"]').change(
                function () {
                    if ($(this).is(':checked')) {
                        var value = $(this).val();
                        if (value == "father") {
                            $('#guardian_name').val($('#father_name').val());
                            $('#guardian_phone').val($('#father_phone').val());
                            $('#guardian_occupation').val($('#father_occupation').val());
                            $('#guardian_relation').val("Father")
                        } else if (value == "mother") {
                            $('#guardian_name').val($('#mother_name').val());
                            $('#guardian_phone').val($('#mother_phone').val());
                            $('#guardian_occupation').val($('#mother_occupation').val());
                            $('#guardian_relation').val("Mother")
                        } else {
                            $('#guardian_name').val("");
                            $('#guardian_phone').val("");
                            $('#guardian_occupation').val("");
                            $('#guardian_relation').val("")
                        }
                    }
                });

            $('#class-dropdown').on('change', function () {
                var idClass = this.value;
                //alert(idClass);
                $("#group-dropdown").html('');
                $.ajax({
                    url: "{{route('fetchGroup')}}",
                    type: "POST",
                    data: {
                        clase_id: idClass,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#group-dropdown').html('<option value="">Select</option>');
                        $.each(result.groups, function (key, value) {
                            $("#group-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

            $('#autofill_current_address').on("change", function () {
                var chkStatus = $(this).is(":checked");
                if (chkStatus == true) {
                    var ga = $('#guardian_address').val();
                    $('#current_address').val(ga);
                } else {
                    $('#current_address').val('');
                }
                //alert('hi');
            });
            $('#autofill_address').on("change", function () {
                var chkStatus = $(this).is(":checked");
                if (chkStatus == true) {
                    var ga = $('#current_address').val();
                    $('#parmanent_address').val(ga);
                } else {
                    $('#parmanent_address').val('');
                }
                //alert('hi');
            });


           /* $('#ch input').on("change", function () {
                var chkStatus = $(this).is(":checked");
                if (chkStatus == true) {
                    var ga = $('#ga textarea').val();
                    $('#ca textarea').val(ga);
                } else {
                    $('#ca textarea').val('');
                }
            });

            var fn = $('#fn input').val();
            //alert(fn);
            var ln = $('#ln input').val();
            $('#fln span').val(fn + ln);*/

        });

        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
            return function () {
                $file = $(this).siblings(tag);

                params = {
                    slug: '{{ $dataType->slug }}',
                    filename: $file.data('file-name'),
                    id: $file.data('id'),
                    field: $file.parent().data('field-name'),
                    multi: isMulti,
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text(params.filename);
                $('#confirm_delete_modal').modal('show');
            };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: ['YYYY-MM-DD']
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function (i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function () {
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if (response
                        && response.data
                        && response.data.status
                        && response.data.status == 200) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function () {
                            $(this).remove();
                        })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@stop
