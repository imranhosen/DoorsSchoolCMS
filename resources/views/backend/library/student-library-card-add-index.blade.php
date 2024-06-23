@extends('voyager::master')

@section('css')
    <style>
        .color {
            color: #e94542;
        }
    </style>
@stop
@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="alert alert-primary text-center" style="background-color:#ededff">
                            <h4 style="color: #134013"><em><strong>Select Criteria</strong></em></h4>
                        </div>
                        <form id="searchStudentClassGroupWaise">
                            <div class="form-group col-md-5">
                                <level for="class">Class<small class="color">*</small></level>
                                <select name="class_id" id="class-dropdown" class="form-control">
                                    <option value="">-- Select Class --</option>
                                    @foreach ($classes as $class)
                                        <option value="{{$class->id}}">
                                            {{$class->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <level for="group">Group<small class="color">*</small></level>
                                <select id="group-dropdown" name="group_id" class="form-control">
                                </select>
                            </div>
                            <div class="form-group col-md-2 pull-right" style="margin-top:17px;">
                                <button type="submit" class="btn btn-primary" id="showTableBtn">Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" hidden="hidden" id="LibraryDiv">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="createCertificate">
                            <div class="row col-sm-12">
                                <h4 style="color: #134013"><i class="fa-solid fa-user-group"></i><bold> Student List</bold></h4>
                            </div>
                            <div class=" col-sm-12">
                                <div class=" table-responsive">
                                    <table class="table table-striped" id="studentTable">
                                        <thead>
                                        <tr>
                                            <th>Member ID</th>
                                            <th>Library Card Number</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Date Of Admission</th>
                                            <th>Father Number</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myLibraryModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: linear-gradient(to right,#03709e,#18c3fd 100%);
    background-image: linear-gradient(to right, rgb(3, 112, 158), rgb(24, 195, 253) 100%);
    background-position-x: initial;
    background-position-y: initial;
    background-size: initial;
    background-repeat-x: initial;
    background-repeat-y: initial;
    background-attachment: initial;
    background-origin: initial;
    background-clip: initial;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="lineModalLabel">Add Member</h3>
                </div>
                <div class="modal-body">
                    <!-- content goes here -->
                    <form action="{{route('updateStudentLibraryCard')}}" id="add_member" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="student_id" id="student_id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Library Card Number</label>
                            <input type="name" class="form-control" name="library_card_no" id="library_card_no">
                            <span class="text-danger" id="library_card_no_error"></span>
                        </div>
                        <button type="submit" class="btn btn-dark btn-sm add-member" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait..">Add</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop



@section('javascript')

    <script>
        $(document).ready(function () {
            $('#studentTable').DataTable( {
                dom: 'Bfrt',
                buttons: [
                    // 'copy',
                    {
                        extend: 'excel',
                        messageTop: 'The information of Student Library Mmbership.'
                    },
                    {
                        extend: 'pdf',
                        messageBottom: null
                    },
                    /* {
                         extend: 'print',
                         messageTop: function () {
                             printCounter++;

                             if ( printCounter === 1 ) {
                                 return 'This is the first time you have printed this document.';
                             }
                             else {
                                 return 'You have printed this document '+printCounter+' times';
                             }
                         },
                         messageBottom: null
                     }*/
                ]
            } );
            $('#searchStudentClassGroupWaise').submit(function (e) {
                e.preventDefault();
                var classId = $('#class-dropdown').val();
                var groupId = $('#group-dropdown').val();
                if (classId > 0) {
                    $.ajax({
                        url: "{{route('fetchStudentForLibraryCard')}}",
                        type: "POST",
                        data: {
                            class_id: classId,
                            group_id: groupId
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            createRows(response);

                        }
                    });
                }

            });

            function createRows(response) {
                var len = 0;
                var icon = '';
                var libraryValue = '';
                $('#LibraryDiv').show();
                $('#studentTable tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var studentId = response['students'][i].id;
                        var libraryId = response['students'][i].library_id;
                        if(libraryId == null){
                            libraryValue = '';
                        }else{
                            libraryValue = libraryId;
                        }
                        var name = response['students'][i].full_name;
                        var email = response['students'][i].email;
                        var AdmissionDate = response['students'][i].admission_date;
                        var fatherNumber = response['students'][i].father_number;
                        if(libraryId == null){
                            icon = "<i class='voyager-plus' title='Add Fees'>"+"</i>";
                        }else{
                            icon = "<i class='voyager-forward' title='Remove Fees'>"+"</i>";
                        }
                        var tr_str = "<tr>" +
                            "<td>" + studentId + "</td>" +
                            "<td>" + libraryValue + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + email + "</td>" +
                            "<td>" + AdmissionDate + "</td>" +
                            "<td>" + fatherNumber + "</td>" +
                           /* "<td>" + "<a class='myCollectFeeBtn' value='" + studentId + "'>"+ icon +"</i>"+ "</a>"+ "</td>" +*/
                            "<td>" + "<button type='button' value='" + studentId + "' class='btn btn-dark myCollectFeeBtn'  id='myCollectFeeBtn'>" + icon + "</i>" + "</button>"
                            + "</td>" +
                            "</tr>";
                        $("#studentTable").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#studentTable tbody").append(tr_str);
                }
            }
            $('body').on('click', '.myCollectFeeBtn', function () {
                var studentId = $(this).val();
                //alert(studentId);
                $.ajax({
                    url: "fetch-student-library-number/" + studentId,
                    type: "GET",
                    success: function (response) {
                        console.log(response);
                        $('#myLibraryModal').modal('show');
                        $('#student_id').val(studentId);
                        $('#library_card_no').val(response.student.library_id);
                        if(response.student.library_id == null){
                        $('#myLibraryModal').modal('show').find('.add-member').text('Add');
                        }else {
                            $('#myLibraryModal').modal('show').find('.add-member').text('Remove');
                        }
                    }
                });
            });
            $('#class-dropdown').on('change', function () {
                var idClass = this.value;
                //console.log(idClass);
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
