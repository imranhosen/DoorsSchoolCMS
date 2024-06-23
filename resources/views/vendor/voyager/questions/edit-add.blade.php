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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bold">Subject</label><small class="req">
                                            *</small>
                                        <select id="subject_dropdown" name="subject_id" class="form-control">
                                            <option value=" ">Select</option>
                                            @foreach($subjects as $subject)
                                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->first('subject_id')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bold">Question Type</label><small
                                            class="req">
                                            *</small>
                                        <select id="question_type" name="question_type" class="form-control">
                                            <option value=" ">Select</option>
                                            <option value="singlechoice">Single Choice</option>
                                            <option value="multichoice">Multiple Choice</option>
                                            <option value="true_false">True/False</option>
                                            <option value="descriptive">Descriptive</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('question_type')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bold">Question Level</label><small
                                            class="req">
                                            *</small>
                                        <select id="question_level_dropdown" name="question_level" class="form-control">
                                            <option value=" ">Select</option>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('question_level')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bold">Class</label><small class="req">
                                            *</small>
                                        <select id="class-dropdown" name="clase_id" class="form-control required">
                                            <option value=" ">Select</option>
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->first('class_id')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bold">Group</label><small class="req">
                                            *</small>
                                        <select id="group-dropdown" name="group_id"
                                                value="{{ old('group_id', $dataTypeContent->group_id ?? '') }}"
                                                class="form-control">
                                        </select>
                                        <span class="text-danger">{{$errors->first('group_id')}}</span>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bold">Section</label><small class="req">
                                            *</small>
                                        <select id="section-dropdown" name="section_id" class="form-control required">
                                            <option value=" ">Select</option>
                                            @foreach($sections as $section)
                                                <option value="{{$section->id}}">{{$section->section}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->first('section_id')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bold">Question</label><small class="req">
                                            *</small>
                                        <textarea id="name-dropdown" name="name" class="form-control required">
                                        </textarea>
                                        <span class="text-danger">{{$errors->first('section_id')}}</span>
                                    </div>
                                </div>


                            </div>
                            <div class="row" hidden="hidden" id="singleChoiceDiv">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_a" class="bold">Option A<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_a" id="opt_a_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_b" class="bold">Option B<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_b" id="opt_b_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_c" class="bold">Option C<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_c" id="opt_c_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_d" class="bold">Option D<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_d" id="opt_d_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_e" class="bold">Option E<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_e" id="opt_e_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bold">Answer</label><small class="req">
                                            *</small>
                                        <select id="answer-dropdown" name="answer" class="form-control required">
                                            <option value=" ">Select</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('answer')}}</span>
                                    </div>
                                </div>


                            </div>

                            <div class="row" hidden="hidden" id="multipleChoiceDiv">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_a" class="bold">Option A<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_a" id="opt_a_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_b" class="bold">Option B<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_b" id="opt_b_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_c" class="bold">Option C<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_c" id="opt_c_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_d" class="bold">Option D<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_d" id="opt_d_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="option_e" class="bold">Option E<small class="req"> *</small></label>
                                        <textarea class="form-control ckeditor" name="option_e" id="opt_e_textbox"
                                                  onkeypress="maxLength()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ans_checkbox" style="display: block;">
                                        <label for="subject_id">Answer</label><small class="req"> *</small>
                                        <div>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="answers[]" value="A">A</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="answers[]" value="B">B</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="answers[]" value="C">C</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="answers[]" value="D">D</label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="answers[]" value="E">E</label>
                                        </div>
                                        <span class="text text-danger ans_error"></span>
                                    </div>
                                </div>


                            </div>
                            <div class="row" hidden="hidden" id="trueFalseDiv">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="bold">Answer</label><small class="req">
                                            *</small>
                                        <select id="answer-dropdown" name="answer" class="form-control required">
                                            <option value=" ">Select</option>
                                            <option value="true">True</option>
                                            <option value="false">False</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('answer')}}</span>
                                    </div>
                                </div>
                            </div>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit"
                                        class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
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
            $(document).on('change','#question_type',function(){
               // alert('hi');
                if($(this).val() == "singlechoice"){
                    $('#trueFalseDiv').hide();
                    $('#multipleChoiceDiv').hide();
                    $('#singleChoiceDiv').show();

                }else if($(this).val() == "true_false"){
                    $('#singleChoiceDiv').hide();
                    $('#multipleChoiceDiv').hide();
                    $('#trueFalseDiv').show();

                }else if($(this).val() == " "){
                    $('#singleChoiceDiv').hide();
                    $('#multipleChoiceDiv').hide();
                    $('#trueFalseDiv').hide();

                }else if($(this).val() == "multichoice"){
                    $('#singleChoiceDiv').hide();
                    $('#trueFalseDiv').hide();
                    $('#multipleChoiceDiv').show();

                }else if($(this).val() == "descriptive"){
                    $('#singleChoiceDiv').hide();
                    $('#trueFalseDiv').hide();
                    $('#multipleChoiceDiv').hide();

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
