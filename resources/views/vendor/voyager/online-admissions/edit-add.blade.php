{{--
@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('frontend.layouts.master')

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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 pt-0-mobile">
                                            <div class="row justify-content-center align-items-center flex-wrap d-flex pt20">
                                                <div class="col-md-12 col-lg-11 col-sm-11">
                                                    <h3 class="entered mt0 mb30" style="text-align: center">Online Admission</h3>
                                                </div>
                                                --}}
{{-- <div class="col-md-6 col-lg-7 col-sm-7 text-lg-right">
                                                     <a href="#checkOnlineAdmissionStatus" class="modalclosebtn modal-close-xs w-full-xs mr-lg-1"
                                                        onclick="openStatusFormmodal();" data-toggle="modal"
                                                        data-target="#checkOnlineAdmissionStatus">Check Your Form Status</a>
                                                     <a href="welcome/download/School_Admission_Form_Sample_Template%5b1%5d%20(2)%20(2)%20(1).pdf"
                                                        class='modalclosebtn modal-close-xs w-full-xs text-center'>Download Application Form</a>
                                                 </div>--}}{{--

                                            </div>
                                            <form id="form1" class="spaceb60 spacet40 onlineform"
                                                  action="https://demo.smart-school.in/online_admission" method="post" accept-charset="utf-8"
                                                  enctype="multipart/form-data">
                                                <div class="printcontent">
                                                    <div class="row">
                                                        <h4 class="pagetitleh2">Instructions</h4>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <p>Please enter your institution online admission instructions here.</p>

                                                                <p>&nbsp;</p>

                                                                <p>&nbsp;</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="printcontent">
                                                    <div class="row">
                                                        <h4 class="pagetitleh2">Basic Details</h4>
                                                          <div class="col-md-3">
                                                              <div class="form-group">
                                                                  <label for="exampleInputEmail1" class="bold">Class</label><small class="req">
                                                                      *</small>
                                                                  <select id="class-dropdown" name="class_id" class="form-control required cls" >
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
                                                                <label for="exampleInputEmail1" class="bold">Group</label><small class="req">
                                                                    *</small>
                                                                <select id="group-dropdown" name="group_id" value="{{ old('group_id', $dataTypeContent->group_id ?? '') }}" class="form-control">
                                                                </select>
                                                                <span class="text-danger">{{$errors->first('group_id')}}</span>

                                                            </div>
                                                        </div>
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
                                                    </div><!--./row-->
                                                    <div class="row">
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
                                                                <label for="exampleInputEmail1" class="bold">Email</label><small class="req"> *</small>
                                                                <input id="email" name="email" type="text" value="{{ old('email', $dataTypeContent->email ?? '') }}"
                                                                       class="form-control">
                                                                <span class="text-danger">{{$errors->first('email')}}</span>
                                                            </div>
                                                        </div>
                                                    </div><!--./row-->
                                                    <div class="row">
                                                    </div><!--./row-->
                                                    <div class="row">
                                                    </div><!--./row-->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile" class="bold">Student Photo</label>
                                                                @if(isset($dataTypeContent->student_image))
                                                                    <img
                                                                        src="{{ filter_var($dataTypeContent->student_image, FILTER_VALIDATE_URL) ? $dataTypeContent->student_image : Voyager::image( $dataTypeContent->student_image ) }}"
                                                                        style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;"/>
                                                                @endif
                                                                <input type="file" data-name="student_image" name="student_image">
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    </div>
                                                </div>
                                                <div class="printcontent">
                                                    <div class="row">
                                                        <h4 class="pagetitleh2">Parent Detail</h4>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="father_name" class="bold">Father Name</label>
                                                                <input id="father_name" name="father_name"
                                                                       type="text" class="form-control" value="{{ old('father_name', $dataTypeContent->father_name ?? '') }}">
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div><!---row-->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="mother_name" class="bold">Mother Name</label>
                                                                <input id="mother_name" name="mother_name"
                                                                       type="text" class="form-control" value="{{ old('mother_name', $dataTypeContent->mother_name ?? '') }}">
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div><!--./row-->
                                                </div><!--./printcontent-->
                                                <div class="printcontent">
                                                    <div class="row">
                                                        <h4 class="pagetitleh2">Guardian Details</h4>
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
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="guardian_name" class="bold">Guardian Name</label>
                                                                <small class="req"> *</small>
                                                                <input id="guardian_name" name="guardian_name"
                                                                       type="text" class="form-control" value="{{ old('guardian_name', $dataTypeContent->guardian_name ?? '') }}">
                                                                <span class="text-danger">{{$errors->first('guardian_name')}}</span>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="guardian_relation" class="bold">Guardian
                                                                    Relation</label><small class="req"> *</small>
                                                                <input id="guardian_relation"
                                                                       name="guardian_relation"
                                                                       type="text" class="form-control" value="{{ old('guardian_relation', $dataTypeContent->guardian_relation ?? '') }}">
                                                                <span class="text-danger">{{$errors->first('guardian_relation')}}</span>
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
                                                    </div><!--./row-->
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="guardian_number" class="bold">Guardian
                                                                    Phone</label><small class="req"> *</small>
                                                                <input id="guardian_number" name="guardian_number"
                                                                       type="number" class="form-control" value="{{ old('guardian_number', $dataTypeContent->guardian_number ?? '') }}">
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="guardian_occupation" class="bold">Guardian
                                                                    Occupation</label>
                                                                <input id="guardian_occupation"
                                                                       name="guardian_occupation"
                                                                       type="text" class="form-control" value="{{ old('guardian_occupation', $dataTypeContent->guardian_occupation ?? '') }}">
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="guardian_address" class="bold">Guardian Address</label>
                                                                <textarea id="guardian_address" name="guardian_address"
                                                                          class="form-control" rows="2" value="{{ old('guardian_address', $dataTypeContent->guardian_address ?? '') }}"></textarea>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="printcontent">
                                                    <div class="row">
                                                        <h4 class="pagetitleh2">Student Address Details</h4>
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
                                                <div class="printcontent">
                                                    <div class="row">
                                                        <h4 class="pagetitleh2">Miscellaneous Details</h4>
                                                    </div>
                                                    <div class="row">
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
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="previousCollege_details" class="bold">Previous
                                                                    College Details</label>
                                                                <textarea class="form-control" rows="3"
                                                                          name="previousCollege_details" value="{{ old('previousCollege_details', $dataTypeContent->previousCollege_details ?? '') }}"></textarea>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="printcontent">
                                                    <div class="row">
                                                        <h4 class="pagetitleh2">Upload Documents</h4>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label> Documents </label> (<small>To Upload Multiple Document Compress It In A
                                                                    Single File Then Upload It</small>)
                                                                <input id="document" name="document" type="file" class="form-control filestyle"
                                                                       value=""/>
                                                                <span class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-5">
                                                        <div class="form-group  ">
                                                            <button type="submit" class="onlineformbtn mt10">Submit</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--./row-->

                                <div id="checkOnlineAdmissionStatus" class="modal fade" role="dialog" tabindex="-1">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header modal-header-small">
                                                <button type="button" class="close closebtnmodal" data-dismiss="modal">&times;</button>
                                                <h4>Check Your Form Status</h4>
                                            </div>
                                            <form action="https://demo.smart-school.in/welcome/checkadmissionstatus" method="post"
                                                  class="onlineform" id="checkstatusform">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Enter Your Reference Number</label><small class="req"> *</small>
                                                        <input type="text" class="form-control" name="refno" id="refno" autocomplete="off">
                                                        <span class="text-danger" id="error_status_refno"></span>
                                                    </div>
                                                    <div class="form-group mb10">
                                                        <label>Select Your Date of Birth</label><small class="req"> *</small>
                                                        <input type="text" class="form-control date2" name="student_dob" id="student_dob"
                                                               autocomplete="off" readonly="">
                                                        <span class="text-danger" id="error_status_dob"></span>
                                                    </div>
                                                    <span class="text-danger" id="invaliderror"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="modalclosebtn btn  mdbtn" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="onlineformbtn mdbtn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>



    <!-- panel-body -->

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
            //$('body').on('change', '.cls', function() {
            $('#class-dropdown').on('change', function () {
                alert('hi');
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
--}}
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
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
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

                            @foreach($dataTypeRows as $row)
                            <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = $row->details->display ?? NULL;
                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                @endif

                                <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $row->slugify }}
                                    <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    @if ($add && isset($row->details->view_add))
                                        @include($row->details->view_add, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'view' => 'add', 'options' => $row->details])
                                    @elseif ($edit && isset($row->details->view_edit))
                                        @include($row->details->view_edit, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'view' => 'edit', 'options' => $row->details])
                                    @elseif (isset($row->details->view))
                                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                                    @elseif ($row->type == 'relationship')
                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                    @else
                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                    @endif

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                    @if ($errors->has($row->field))
                                        @foreach ($errors->get($row->field) as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save" style="margin-left: 15px">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <div style="display:none">
                        <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
                        <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
            return function() {
                $file = $(this).siblings(tag);

                params = {
                    slug:   '{{ $dataType->slug }}',
                    filename:  $file.data('file-name'),
                    id:     $file.data('id'),
                    field:  $file.parent().data('field-name'),
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
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
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

