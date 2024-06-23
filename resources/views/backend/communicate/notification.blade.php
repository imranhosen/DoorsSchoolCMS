@extends('voyager::master')

@section('css')
    <style>
        .req {
            color: #e94542;
        }
    </style>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- left column -->
            <form id="form1" action="http://kajcc.edu.bd/admin/notification/add" name="employeeform" method="post"
                  accept-charset="utf-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-envelope"></i> Compose New Message</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class=" form-group col-md-9">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label><small class="req"> *</small>
                                    <input autofocus="" id="title" name="title" placeholder="" type="text"
                                           class="form-control" value="" autocomplete="off">
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group"><label>Message</label><small class="req"> *</small>
                                    {{-- <ul class="wysihtml5-toolbar" style=""><li class="dropdown">
                                             <a class="btn btn-default dropdown-toggle " data-toggle="dropdown">

                                                 <span class="glyphicon glyphicon-font"></span>

                                                 <span class="current-font">Normal text</span>
                                                 <b class="caret"></b>
                                             </a>
                                             <ul class="dropdown-menu">
                                                 <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p" tabindex="-1" href="javascript:;" unselectable="on" class="wysihtml5-command-active">Normal text</a></li>
                                                 <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" tabindex="-1" href="javascript:;" unselectable="on">Heading 1</a></li>
                                                 <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" tabindex="-1" href="javascript:;" unselectable="on">Heading 2</a></li>
                                                 <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" tabindex="-1" href="javascript:;" unselectable="on">Heading 3</a></li>
                                                 <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" tabindex="-1" href="javascript:;" unselectable="on">Heading 4</a></li>
                                                 <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h5" tabindex="-1" href="javascript:;" unselectable="on">Heading 5</a></li>
                                                 <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h6" tabindex="-1" href="javascript:;" unselectable="on">Heading 6</a></li>
                                             </ul>
                                         </li>
                                         <li>
                                             <div class="btn-group">
                                                 <a class="btn btn-default" data-wysihtml5-command="bold" title="CTRL+B" tabindex="-1" href="javascript:;" unselectable="on">Bold</a>
                                                 <a class="btn btn-default" data-wysihtml5-command="italic" title="CTRL+I" tabindex="-1" href="javascript:;" unselectable="on">Italic</a>
                                                 <a class="btn btn-default" data-wysihtml5-command="underline" title="CTRL+U" tabindex="-1" href="javascript:;" unselectable="on">Underline</a>

                                                 <a class="btn btn-default" data-wysihtml5-command="small" title="CTRL+S" tabindex="-1" href="javascript:;" unselectable="on">Small</a>

                                             </div>
                                         </li>
                                         <li>
                                             <a class="btn btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="blockquote" data-wysihtml5-display-format-name="false" tabindex="-1" href="javascript:;" unselectable="on">

                                                 <span class="glyphicon glyphicon-quote"></span>

                                             </a>
                                         </li>
                                         <li>
                                             <div class="btn-group">
                                                 <a class="btn btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered list" tabindex="-1" href="javascript:;" unselectable="on">

                                                     <span class="glyphicon glyphicon-list"></span>

                                                 </a>
                                                 <a class="btn btn-default" data-wysihtml5-command="insertOrderedList" title="Ordered list" tabindex="-1" href="javascript:;" unselectable="on">

                                                     <span class="glyphicon glyphicon-th-list"></span>

                                                 </a>
                                                 <a class="btn btn-default" data-wysihtml5-command="Outdent" title="Outdent" tabindex="-1" href="javascript:;" unselectable="on">

                                                     <span class="glyphicon glyphicon-indent-right"></span>

                                                 </a>
                                                 <a class="btn btn-default" data-wysihtml5-command="Indent" title="Indent" tabindex="-1" href="javascript:;" unselectable="on">

                                                     <span class="glyphicon glyphicon-indent-left"></span>

                                                 </a>
                                             </div>
                                         </li>
                                         <li>
                                             <div class="bootstrap-wysihtml5-insert-link-modal modal fade" data-wysihtml5-dialog="createLink">
                                                 <div class="modal-dialog ">
                                                     <div class="modal-content">
                                                         <div class="modal-header">
                                                             <a class="close" data-dismiss="modal">×</a>
                                                             <h3>Insert link</h3>
                                                         </div>
                                                         <div class="modal-body">
                                                             <div class="form-group">
                                                                 <input value="http://" class="bootstrap-wysihtml5-insert-link-url form-control" data-wysihtml5-dialog-field="href">
                                                             </div>
                                                             <div class="checkbox">
                                                                 <label>
                                                                     <input type="checkbox" class="bootstrap-wysihtml5-insert-link-target" checked="">Open link in new window
                                                                 </label>
                                                             </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                             <a class="btn btn-default" data-dismiss="modal" data-wysihtml5-dialog-action="cancel" href="#">Cancel</a>
                                                             <a href="#" class="btn btn-primary" data-dismiss="modal" data-wysihtml5-dialog-action="save">Insert link</a>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <a class="btn btn-default" data-wysihtml5-command="createLink" title="Insert link" tabindex="-1" href="javascript:;" unselectable="on">

                                                 <span class="glyphicon glyphicon-share"></span>

                                             </a>
                                         </li>
                                         <li>
                                             <div class="bootstrap-wysihtml5-insert-image-modal modal fade" data-wysihtml5-dialog="insertImage">
                                                 <div class="modal-dialog ">
                                                     <div class="modal-content">
                                                         <div class="modal-header">
                                                             <a class="close" data-dismiss="modal">×</a>
                                                             <h3>Insert image</h3>
                                                         </div>
                                                         <div class="modal-body">
                                                             <div class="form-group">
                                                                 <input value="http://" class="bootstrap-wysihtml5-insert-image-url form-control" data-wysihtml5-dialog-field="src">
                                                             </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                             <a class="btn btn-default" data-dismiss="modal" data-wysihtml5-dialog-action="cancel" href="#">Cancel</a>
                                                             <a class="btn btn-primary" data-dismiss="modal" data-wysihtml5-dialog-action="save" href="#">Insert image</a>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <a class="btn btn-default" data-wysihtml5-command="insertImage" title="Insert image" tabindex="-1" href="javascript:;" unselectable="on">

                                                 <span class="glyphicon glyphicon-picture"></span>

                                             </a>
                                         </li>
                                     </ul>--}}
                                    <textarea id="compose-textarea" name="message" class="form-control"
                                              style="height: 300px;"> </textarea>
                                    <input type="hidden" name="_wysihtml5_mode" value="1">
                                    <span class="text-danger"></span>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Notice Date</label><small class="req"> *</small>
                                        <input id="date" name="date" placeholder="" type="text"
                                               class="form-control date" value="" autocomplete="off">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Publish On</label><small class="req"> *</small>
                                        <input id="publish_date" name="publish_date" placeholder="" type="text"
                                               class="form-control date" value="" autocomplete="off">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-horizontal">
                                        <label for="exampleInputEmail1">Message To</label>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="student">
                                                <b>Student</b> </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="parent"> <b>Parent</b></label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="1"> <b>ADMIN</b>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="2"> <b>Teacher</b>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="3"> <b>Accountant</b>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="4"> <b>Librarian</b>
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="7" checked=""> <b>Super
                                                    Admin</b> </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="8"> <b>Office
                                                    Staff</b> </label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="visible[]" value="9"> <b>Computer
                                                    Operator</b> </label>
                                        </div>

                                    </div>
                                    <span class="text-danger"></span>

                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="pull-right">

                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            $("#compose-textarea").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#class-dropdown').on('change', function () {
                var classId = this.value;
                //console.log(idClass);
                $("#group-dropdown").html('');
                $.ajax({
                    url: "{{route('fetchGroup')}}",
                    type: "POST",
                    data: {
                        clase_id: classId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#group-dropdown').html('<option value="">-- Select Group --</option>');
                        $.each(result.groups, function (key, value) {
                            $("#group-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@stop
