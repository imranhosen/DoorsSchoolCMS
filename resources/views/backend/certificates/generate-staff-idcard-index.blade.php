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
                        <form id="searchStudentClassGroupSectionWaise">
                            <div class="form-group col-md-6">
                                <level for="role" class="bold">Role</level>
                                <small class="color"> *</small>
                                <select name="role_id" id="role-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}" class="bold">
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <level for="idCard" class="bold">ID Card Template</level>
                                <small class="color"> *</small>
                                <select name="staffidcard_id" id="staffidcard-dropdown" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($staff_id_cards as $staff_id_card)
                                        <option value="{{$staff_id_card->id}}" class="bold">
                                            {{$staff_id_card->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-1 pull-right">
                                <button type="submit" class="btn btn-primary" id="showTableBtn">Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid" hidden="hidden" id="certificateDiv">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="createMarksheet">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <h4 style="color: #134013; margin-top: 12px"><i class="fa-solid fa-user-group"></i>
                                        <bold> Student List</bold>
                                    </h4>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" class="btn btn-dark btn-sm pull-right pull-top"
                                            id="load" style="margin-bottom: 10px">
                                        Generate ID
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class=" table-responsive">
                                    <table class="table table-striped" id="studentTable">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select_all">All</th>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Role</th>
                                            <th>Designation</th>
                                            <th>Department</th>
                                            <th>Father Name</th>
                                            <th>Mother Name</th>
                                            <th>Date of Joining</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
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

    <div class="modal-dialog modal-md" id="staffidcardDiv">
    </div>


@stop

@section('javascript')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>--}}
    <script>
        $(document).ready(function () {
            //window.jsPDF = window.jspdf.jsPDF;

            $('#select_all').change(function () {
                $('.checkbox').prop('checked', $(this).prop('checked'));
                $('.checkbox').on('click', function () {
                    if ($('.checkbox:checked').length == $('.checkbox').length) {
                        $('#select_all').prop('checked', true);
                    } else {
                        $('#select_all').prop('checked', false);
                    }
                });
            });
            $('#searchStudentClassGroupSectionWaise').submit(function (e) {
                e.preventDefault();
                var roleId = $('#role-dropdown').val();
                //var staffIdCardId = $('#staffidcard-dropdown').val();
                if (roleId > 0) {
                    $.ajax({
                        url: "{{route('fetchStaffForIdCard')}}",
                        type: "POST",
                        data: {
                            role_id: roleId
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
                $('#studentTable tbody').empty();
                if (response['staffs'] != null) {
                    len = response['staffs'].length;
                }
                if (len > 0) {
                    $('#certificateDiv').show();
                    //var certificateId = response['certificates'][0].id;
                    //alert(certificateId);
                    for (var i = 0; i < len; i++) {
                        var gender;
                        if (response['staffs'][i].gender == 1) {
                            gender = 'Male';
                        } else if (response['staffs'][i].gender == 2) {
                            gender = 'Female';
                        } else {
                            gender = 'Others';
                        }
                        var staffId = response['staffs'][i].id;
                        var staffIdNo = response['staffs'][i].employee_id;
                        var roleName = response['staffs'][i].role.name;
                        var name = response['staffs'][i].full_name;
                        var designation = response['staffs'][i].designation.designation_name;
                        var department = response['staffs'][i].department.department_name;
                        var fatherName = response['staffs'][i].father_name;
                        var motherName = response['staffs'][i].mother_name;
                        var doj = response['staffs'][i].doj;
                        var dob = response['staffs'][i].dob;
                        var mobileNumber = response['staffs'][i].contact_no;
                        // var gender = response['students'][i].gender;
                        var tr_str = "<tr>" +
                            "<td>" + "<input class='checkbox' id='staff_id' type='checkbox' name='staff_ids' value='" + staffId + "'>" + "</td>" +
                            "<td>" + staffIdNo + "</td>" +
                            "<td>" + name + "</td>" +
                            "<td>" + roleName + "</td>" +
                            "<td>" + designation + "</td>" +
                            "<td>" + department + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + motherName + "</td>" +
                            "<td>" + doj + "</td>" +
                            "<td>" + mobileNumber + "</td>" +
                            "<td>" + gender + "</td>" +
                            "<td>" + dob + "</td>" +
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
            $('#createMarksheet').submit(function (e) {
                e.preventDefault();
                var staffidcardId = $('#staffidcard-dropdown').val();
                var myCheckboxes = new Array();
                $("input[name='staff_ids']:checked").each(function () {
                    myCheckboxes.push($(this).val());
                });
                if (staffidcardId > 0) {
                    $.ajax({
                        url: "{{route('generateStaffIdCard')}}",
                        type: "POST",
                        data: {
                            staffidcard_id: staffidcardId,
                            staff_ids: myCheckboxes
                        },
                        dataType: 'json',
                        success: function (res) {
                            console.log(res);
                            createRows2(res);
                            //downloadTableAsPDF();
                        }
                    });
                }
            });

            function createRows2(res) {
                var len = 0;
                if (res['staffs'] != null) {
                    len = res['staffs'].length;
                    //alert(len);
                }
                if (len > 0) {
                    $('#certificateDiv').hide();
                    $('#staffidcardDiv').show();
                    for (var i = 0; i < len; i++) {
                        var gender;
                        if (res['staffs'][i].gender == 1) {
                            gender = 'Male';
                        } else if (res['staffs'][i].gender == 2) {
                            gender = 'Female';
                        } else {
                            gender = 'Others';
                        }
                        var Id = res['staffs'][i].id;
                        var staffName = res['staffs'][i].full_name;
                        var staffIdNo = res['staffs'][i].employee_id;
                        var roleName = res['staffs'][i].role.name;
                        var name = res['staffs'][i].full_name;
                        var designation = res['staffs'][i].designation.designation_name;
                        var department = res['staffs'][i].department.department_name;
                        var fatherName = res['staffs'][i].father_name;
                        var motherName = res['staffs'][i].mother_name;
                        var doj = res['staffs'][i].doj;
                        var dob = res['staffs'][i].dob;
                        var mobileNumber = res['staffs'][i].contact_no;
                        var staffAddress = res['staffs'][i].contact_no;
                        var staffimage = res['staffs'][i].staffImages;

                        /*var heading = res['admitcards'][0].heading;
                        var leftLogo = res['leftLogo'];
                        var rightLogo = res['rightLogo'];
                        var bgImage = res['bgimage'];
                        var signImage = res['sign'];
                        var title = res['admitcards'][0].title;
                        var examName = res['admitcards'][0].exam_name;*/
                        var schoolName = res['staffidcards'][0].school_name;
                        var addressPhoneEmail = res['staffidcards'][0].address_phone_email;
                        var headerColor = res['staffidcards'][0].header_color;
                        var sign = res['sign'];
                        var bgImage = res['bgimage'];
                        var logo = res['logo'];
                        /*var footerText = res['admitcards'][0].footer_text;*/
                        if(res['staffidcards'][0].design_type != 0) {
                            var tr_str = "<div class='modal-content'>" +
                                "<div class='modal-body' id='certificate_detail'>" +
                                /*'<div class="modal-inner-loader displaynone">'+"</div>"+*/
                                '<div class="modal-inner-content">' +
                                `<style type="text/css">
                            { margin:0; padding: 0;}
                        /*body{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000;}*/
                    .tc-container{width: 100%;position: relative; text-align: center;}
                    .tcmybg {
                            background: top center;
                            background-size: contain;
                            position: absolute;
                            left: 0;
                            bottom: 10px;
                            width: 200px;
                            height: 200px;
                            margin-left: auto;
                            margin-right: auto;
                            right: 0;
                        }
                        /*begin students id card*/
                    .studenttop img{width:30px;vertical-align: top;}
                    .studenttop{background: #4e6fb5;padding:2px;color: #fff;overflow: hidden;
                            position: relative;z-index: 1;}
                    .sttext1{font-size: 24px;font-weight: bold;line-height: 30px;}
                    .stgray{background: #efefef;padding-top: 5px; padding-bottom: 10px;}
                    .staddress{margin-bottom: 0; padding-top: 2px;}
                    .stdivider{border-bottom: 2px solid #000;margin-top: 5px; margin-bottom: 5px;}
                    .stlist{padding: 0; margin:0; list-style: none;}
                    .stlist li{text-align: left;display: inline-block;width: 100%;padding: 0px 5px;}
                    .stlist li span{width:65%;float: right;}
                    .stimg{ width: 80px; height: auto;}
                    .stimg img{width: 100%;height: auto;border-radius: 2px;display: block;}
                    .img-circle {border-radius: 50% !important;}
                    .staround{padding:3px 10px 3px 0;position: relative;overflow: hidden;}
                    .staround2{position: relative; z-index: 9;}
                    .stbottom{background: #453278;height: 20px;width: 100%;clear: both;margin-bottom: 5px;}
                    .principal{margin-top: -40px;margin-right:10px; float:right;}
                    .stred{color: #000;}
                    .spanlr{padding-left: 5px; padding-right: 5px;}
                    .cardleft{width: 20%;float: left;}
                    .cardright{width: 77%;float: right; }
                    .signature{border:1px solid #ddd; display:block; text-align: center; padding: 5px 20px; margin-top: 10px;}
                    .vertlist{padding: 0; margin:0; list-style: none;}
                    .vertlist li{text-align: left;display: inline-block;width: 100%; padding-bottom: 5px;color: #000;}
                    .vertlist li span{width:65%;float: right;}
                    </style>` +
                                '<table cellpadding="0" cellspacing="0" width="100%" style="background: ' + headerColor + ';">' +
                                '<tbody>' +
                                '<tr>' +
                                '<td valign="top">' +
                                '<img src="' + bgImage + '" class="tcmybg" style="opacity: .1">' +
                                '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td valign="top" style="text-align: center;color: #fff;padding: 10px;min-height: 110px;display: block;">' +
                                '<table cellpadding="0" cellspacing="0" width="100%">' +
                                '<tbody>' +
                                '<tr>' +
                                '<td valign="top">' +
                                '<div style="color: #fff;position: relative; z-index: 1;">' +
                                '<div class="sttext1">' +
                                '<img src="' + logo + '" width="30" height="30">' + schoolName + '</div>' +
                                '</div>' +
                                '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td valign="top" style="color: #fff">' + addressPhoneEmail + '</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                                '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td valign="top" style="background: #fff">' +
                                '<table cellpadding="0" cellspacing="0" width="100%" style="margin-top: -40px; position: relative;z-index: 1;">' +
                                '<tbody>' +
                                '<tr>' +
                                '<td valign="top">' +
                                '<div class="stimg center-block">' +
                                '<img src="' + staffimage + '" class="img-responsive img-circle block-center" style="border:5px solid #4e6fb5">' +
                                '</div>' +
                                '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td valign="top" style="text-align: center;">';
                            if (res['staffidcards'][0].name != 0) {
                                tr_str += '<h4 style="margin:0; text-transform: uppercase;font-weight: bold; margin-top: 10px;">' + staffName + '</h4>';
                            }
                            tr_str += '<p style="font-size: 15px;color: #9b1818;">' + roleName + '</p>' +
                                '</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                                '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td valign="top">' +
                                '<table cellpadding="0" width="80%" align="center" style="background: #fff;padding: 20px 20px;display: block;">' +
                                '<tbody>' +
                                '<tr>' +
                                '<td valign="top">' +
                                '<ul class="vertlist">';
                            if (res['staffidcards'][0].staff_id != 0) {
                                tr_str += '<li>' + 'Staff ID' + '<span>' + staffIdNo + '</span>' + '</li>';
                            }
                            if (res['staffidcards'][0].designation != 0) {
                                tr_str += '<li>' + 'Designation' + '<span>' + designation + '</span>' + '</li>';
                            }
                            if (res['staffidcards'][0].department != 0) {
                                tr_str += '<li>' + 'Department' + '<span>' + department + '</span>' + '</li>';
                            }
                            if (res['staffidcards'][0].father_name != 0) {
                                tr_str += '<li>' + 'Father Name' + '<span>' + fatherName + '</span>' + '</li>';
                            }
                            if (res['staffidcards'][0].mother_name != 0) {
                                tr_str += '<li>' + 'Mother Name' + '<span>' + motherName + '</span>' + '</li>';
                            }
                            if (res['staffidcards'][0].doj != 0) {
                                tr_str += '<li>' + 'Date of Joining' + '<span>' + doj + '</span>' + '</li>';
                            }
                            if (res['staffidcards'][0].address != 0) {
                                tr_str += '<li>' + 'Address' + '<span>' + staffAddress + '</span>' + '</li>';
                            }
                            if (res['staffidcards'][0].phone != 0) {
                                tr_str += '<li>' + 'Phone' + '<span>' + mobileNumber + '</span>' + '</li>';
                            }
                            if (res['staffidcards'][0].dob != 0) {
                                tr_str += '<li>' + 'Date Of Birth' + '<span>' + dob + '</span>' + '</li>';
                            }
                            tr_str += '</ul>' +
                                '<div class="signature">' +
                                '<img src="' + sign + '" width="200" height="24">' +
                                '</div>' +
                                '</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                                '</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                                '</div>' +
                                '</div>' +
                                '</div>'+'</br>';
                            $("#staffidcardDiv").append(tr_str);
                        }else{
                            tr_str = `<div class="modal-content">
           <div class="modal-body" id="certificate_detail">
                <div class="modal-inner-content">
                 <style type="text/css">
                        { margin:0; padding: 0;}
                        /*body{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000;}*/
                        .tc-container{width: 100%;position: relative; text-align: center;}
                        .tcmybg {
                            background: top center;
                            background-size: contain;
                            position: absolute;
                            left: 0;
                            bottom: 10px;
                            width: 200px;
                            height: 200px;
                            margin-left: auto;
                            margin-right: auto;
                            right: 0;
                        }
                        /*begin students id card*/
                        .studenttop img{width:30px;vertical-align: top;}
                        .studenttop{background: ${headerColor};padding:2px;color: #fff;overflow: hidden;
                            position: relative;z-index: 1;}
                        .sttext1{font-size: 24px;font-weight: bold;line-height: 30px;}
                        .stgray{background: #efefef;padding-top: 5px; padding-bottom: 10px;}
                        .staddress{margin-bottom: 0; padding-top: 2px;}
                        .stdivider{border-bottom: 2px solid #000;margin-top: 5px; margin-bottom: 5px;}
                        .stlist{padding: 0; margin:0; list-style: none;}
                        .stlist li{text-align: left;display: inline-block;width: 100%;padding: 0px 5px;}
                        .stlist li span{width:65%;float: right;}
                        .stimg{ width: 80px; height: auto;}
                        .stimg img{width: 100%;height: auto;border-radius: 2px;display: block;}
                        .img-circle {border-radius: 50% !important;}
                        .staround{padding:3px 10px 3px 0;position: relative;overflow: hidden;}
                        .staround2{position: relative; z-index: 9;}
                        .stbottom{background: #453278;height: 20px;width: 100%;clear: both;margin-bottom: 5px;}
                        .principal{margin-top: -40px;margin-right:10px; float:right;}
                        .stred{color: #000;}
                        .spanlr{padding-left: 5px; padding-right: 5px;}
                        .cardleft{width: 20%;float: left;}
                        .cardright{width: 77%;float: right; }
                        .signature{border:1px solid #ddd; display:block; text-align: center; padding: 5px 20px; margin-top: 10px;}
                        .vertlist{padding: 0; margin:0; list-style: none;}
                        .vertlist li{text-align: left;display: inline-block;width: 100%; padding-bottom: 5px;color: #000;}
                        .vertlist li span{width:65%;float: right;}
                    </style>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr>
                            <td valign="top" width="32%" style="padding: 3px;">
                                <table cellpadding="0" cellspacing="0" width="100%" class="tc-container" style="background: #efefef;">
                                    <tbody><tr>
                                        <td valign="top">
                                            <img src="${bgImage}" class="tcmybg" style="opacity: .1"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <div class="studenttop">
                                                <div class="sttext1"><img src="${logo}" width="30" height="30">
                                                    KAJCC COLLEGE</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="center" style="padding: 1px 0;">
                                            <p>${addressPhoneEmail}</p>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="color: #fff;font-size: 16px; padding: 2px 0 0; position: relative; z-index: 1;background: ${headerColor};text-transform: uppercase;">New</td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <div class="staround">
                                                <div class="cardleft">
                                                    <div class="stimg">
                                                        <img src="${staffimage}" class="img-responsive">
                                                    </div>
                                                </div>
                            <div class="cardright">
                            <ul class="stlist">`;
                          if (res['staffidcards'][0].name != 0) {
                              tr_str += `<li>Staff Name<span>${staffName}</span></li>`;
                          }
                            if (res['staffidcards'][0].staff_id != 0) {
                                tr_str += `<li>Staff ID<span>${staffIdNo}</span></li>`;
                            }
                            if (res['staffidcards'][0].designation != 0) {
                                tr_str += `<li>Designation<span>${designation}</span></li>`;
                            }
                            if (res['staffidcards'][0].department != 0) {
                                tr_str += `<li>Department<span>${department}</span></li>`;
                            }
                            if (res['staffidcards'][0].father_name != 0) {
                                tr_str += `<li>Father Name<span>${fatherName}</span></li>`;
                            }
                            if (res['staffidcards'][0].mother_name != 0) {
                                tr_str += `<li>Mother Name<span>${motherName}</span></li>`;
                            }
                            if (res['staffidcards'][0].doj != 0) {
                                tr_str += `<li>Date Of Joining<span>${doj}span></li>`;
                            }
                            if (res['staffidcards'][0].address != 0) {
                                tr_str += `<li>Address<span>${staffAddress}</span></li>`;
                            }
                            if (res['staffidcards'][0].phone != 0) {
                                tr_str += `<li>Phone<span>${mobileNumber}</span></li>`;
                            }
                            if (res['staffidcards'][0].dob != 0) {
                                tr_str += `<li>Date Of Birth<span>${dob}</span></li>`;
                            }
                            tr_str += `</ul>
                            </div>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td valign="top" align="right" class="principal">
                            <img src="${sign}" width="66" height="40"></td>
                            </tr>
                            <tr>
                            </tr>
                            </tbody></table>
                            </td>
                            </tr>
                            </tbody></table>
                            </div>
                            </div>
                            </div>
                              </br>`;
                            $("#staffidcardDiv").append(tr_str);
                        }
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";
                    $("#staffidcardDiv").append(tr_str);
                }
            }
            /*function downloadTableAsPDF() {
                // Create a new jsPDF instance
                const doc = new jsPDF();

                // Get the table content
                const table = document.getElementById('staffidcardDiv');
                const tableHtml = table.innerHTML;

                // Generate the PDF
               // doc.fromHTML(tableHtml, 10, 10);
                //doc.html(tableHtml, 10, 10);
                doc.html(tableHtml, {
                    'x': 15,
                    'y': 15,
                    'width': 200
                });
                doc.save('table.pdf');
            }*/


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
                        $('#group-dropdown').html('<option value="">None</option>');
                        $.each(result.groups, function (key, value) {
                            $("#group-dropdown").append('<option value="' + value
                                .id + '" class="bold">' + value.name + '</option>');
                        });
                    }
                });
            });
            $('#examgroup-dropdown').on('change', function () {
                var examGroupId = this.value;
                //console.log(idClass);
                $("#exam-dropdown").html('');
                $.ajax({
                    url: "{{route('fetchExam')}}",
                    type: "POST",
                    data: {
                        examgroup_id: examGroupId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#exam-dropdown').html('<option value="">None</option>');
                        $.each(result.exams, function (key, value) {
                            $("#exam-dropdown").append('<option value="' + value
                                .id + '" class="bold">' + value.name + '</option>');
                        });
                    }
                });
            });

        });
    </script>
@stop
