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
                        <div class="col-md-6">
                            <div class="row">
                                <form id="searchByRole">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select name="role_id" id="role_id" class="form-control">
                                                <option value="">-- Select --</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}">
                                                        {{$role->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" name="search" value="search_filter"
                                                    class="btn btn-primary btn-sm pull-right checkbox-toggle"><i
                                                    class="fa fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <form id="searchByStaff">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Search By Keyword</label>
                                            <input type="text" name="search_text" id="search_text" class="form-control"
                                                   placeholder="Search By Staff ID, Name, Role etc..."
                                                   autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" name="search" value="search_full"
                                                    class="btn btn-primary pull-right btn-sm checkbox-toggle"><i
                                                    class="fa fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">

                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><i class="fa-sharp fa-solid fa-film"></i> Card View</a></li>
                                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true"><i class="fa-sharp fa-solid fa-bars"></i> List View</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane table-responsive no-padding" id="tab_2">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                        <table class="table table-striped table-bordered table-hover example dataTable no-footer dtr-inline"
                                            cellspacing="0" width="100%" id="DataTables_Table_0" role="grid"
                                            aria-describedby="DataTables_Table_0_info" style="width: 100%;">
                                            <thead>
                                            <tr role="row">
                                                <th>Staff ID</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>Mobile Number</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody1">
                                            @foreach($staffs as $staff)
                                            <tr role="row" class="odd">
                                                <td tabindex="0">{{$staff->id}}</td>
                                                <td>
                                                    <a href="{{route('voyager.staff.show',$staff->id)}}">{{$staff->full_name}}</a>
                                                </td>

                                                <td>{{$staff->role->name}}</td>
                                                <td>{{$staff->department?->department_name}}</td>
                                                <td>{{$staff->designation->designation_name}}</td>
                                                <td>031-2854600</td>

                                                <td class="pull-right">
                                                    <a href="{{route('voyager.staff.show',$staff->id)}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       title="Show">
                                                        <i class="fa-sharp fa-solid fa-bars"></i>
                                                    </a>
                                                    <a href="{{route('voyager.staff.edit',$staff->id)}}"
                                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                                       title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="tab_1">
                                    <div class="mediarow">
                                        <div class="clearfix container-fluid row" id="cardDiv">
                                            @foreach($staffs as $staff)
                                                <div class="col-xs-12 col-sm-6 col-md-4" style="height: 500px">
                                                    <div class="panel widget center bgimage"
                                                         style="margin-bottom:0;overflow:hidden;background-image:url('http://127.0.0.1:8000/admin/voyager-assets?path=images%2Fwidget-backgrounds%2F01.jpg');">
                                                        <div class="dimmer"></div>
                                                        <div class="panel-content">
                                                            <i><img width="115" height="115" class="round5"
                                                                    src="{{ Voyager::image($staff->staff_image) }}"></i>
                                                                <h4>{{$staff->full_name}}</h4>
                                                                <h4>{{$staff->designation->designation_name}}</h4>
                                                                <h4>{{$staff->contact_no}}</h4>
                                                                <h4>{{$staff->department?->department_name}}</h4>
                                                                <h4>{{$staff->role->name}}</h4>
                                                            {{--<p>{{$staff->subjects->name}}</p>--}}
                                                            <div class="form-row">
                                                                <a href="{{route('voyager.staff.show',$staff->id)}}"
                                                                   class="btn btn-primary">View</a>
                                                                <a href="{{route('voyager.staff.edit',$staff->id)}}" class="btn btn-primary">Edit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    {{--<div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/1.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Karnaphuli A J Chowdhury College </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">1</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">031-2854600</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Super Admin</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/1"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/1"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/2.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Mohammad Jashim Uddin </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01819547794</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> BIOLOGY</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">PRINCIPAL</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/2"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/2"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/3.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Samir Ranjan Nath </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">02</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01711903587</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> ACCOUNTING </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">VICE PRINCIPAL</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/3"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/3"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/4.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Pradip Roy </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">03</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> MATHMETICS</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">ASSISTANT PROFESSOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/4"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/4"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/5.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Md. Shafiqur Rashid </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">04</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> ECONOMICS</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">ASSISTANT PROFESSOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/5"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/5"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/6.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Shamim Akhter Chowdhury </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">05</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> ENGLISH</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">ASSISTANT PROFESSOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/6"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/6"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/7.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">H M Abu Obaida </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">06</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> POLITICAL SCIENCE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">ASSISTANT PROFESSOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/7"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/7"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/8.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Taznin Ferdous </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">07</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> POLITICAL SCIENCE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">ASSISTANT PROFESSOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/8"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/8"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/9.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Nazma Begum </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">08</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01830225246</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> FINANCE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">ASSISTANT PROFESSOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/9"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/9"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/10.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Indrojit kar </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">09</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01615337755</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> ACCOUNTING </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">SENIOR LECTURER </span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/10"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/10"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/11.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Roksana Khatun </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">10</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01815815909</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> ISLAMIC HISTORY &amp; CULTURE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">SENIOR LECTURER </span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/11"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/11"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/12.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Nazneen Sultana </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">11</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> ECONOMICS</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">SENIOR LECTURER </span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/12"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/12"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/13.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Abdul Kaiyoum </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">12</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01911797071</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> INFORMATION COMMUNICATION &amp;TECHNOLOGY(ICT)</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">SENIOR LECTURER </span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/13"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/13"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/14.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Sujon Das </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">13</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01817206715</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> PHYSICS</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/14"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/14"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/15.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Biswajit Biswas </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">14</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01726230308</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> BIOLOGY</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/15"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/15"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/17.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Abdul Jalil </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">16</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01813374127</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> MANAGEMENT</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/17"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/17"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/18.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Ershadul Islam </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">17</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01815668886</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> PHILOSOPHY</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/18"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/18"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/19.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Monwara Begum </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">18</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01811612220</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> ENGLISH</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/19"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/19"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/20.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Mst. Rowshan Akther </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">19</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01816283159</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> ISLAMIC HISTORY &amp; CULTURE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/20"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/20"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/21.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Mobarak Hossain </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">20</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01812353990</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> BANGLA</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/21"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/21"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/22.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Mohammad Harun-Ur-Rashid </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">21</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> PHILOSOPHY</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/22"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/22"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/23.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Ashraf Ali </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">22</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01749117701</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> BANGLA</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/23"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/23"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/24.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Anupam Das Gupta </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">23</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01829925932</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> CHEMISTRY</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/24"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/24"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/25.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Fatema Farhana </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">24</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01675435057</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> COMPUTER OPERATION(BM)</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/25"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/25"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/26.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Mohammed Nurul Amin </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">25</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01859194648</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> PHYSICS</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">DEMONSTRATOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/26"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/26"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/27.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Pushpen Bhattacharjee </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">26</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01730165814</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> BIOLOGY</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">DEMONSTRATOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/27"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/27"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/28.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Biplob Kumar Chowdhury </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">27</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01819309623</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> CHEMISTRY</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">DEMONSTRATOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/28"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/28"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/29.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Farida Yeasmin </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">28</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01716259080</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> LIBRARY</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Librarian</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER - LIBRARY</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/29"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/29"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/30.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Md. Habibur Rahman </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">29</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01832517684</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> PHYSICAL EXERCISE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">PHYSICAL EDUCATION TEACHER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/30"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/30"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/31.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Bably Aktar </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">31</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01812766826</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> LIBRARY</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Librarian</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">ASSISTSNT TEACHER - LIBRARY &amp; INFO SCIENCE</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/31"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/31"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/32.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Md. Nayem Uddin</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">3G103</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01817753929</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> OFFICE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Accountant</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT CUM ACCOUNTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/32"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/32"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/33.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Md. Ziauddin Ripon</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">3G101</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01671322958</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> OFFICE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Computer Operator</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT CUM COMPUTER OPERATOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/33"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/33"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/34.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Abdul Karim</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">3G102</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01673537553</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> OFFICE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Computer Operator</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT CUM COMPUTER OPERATOR</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/34"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/34"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/35.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Krishna Kanta Nath</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">35</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01875993585</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Accountant</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT CUM ACCOUNTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/35"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/35"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/36.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Laxman Chandra Nath</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">36</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01836764511</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Office Staff</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/36"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/36"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/37.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Md. Shafiqur Rahman</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">37</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01818219048</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Office Staff</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/37"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/37"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/38.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Md. Shahidul Islam</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">39</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01835052483</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Office Staff</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/38"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/38"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/39.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Md. Abdur Rouf</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">40</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01872353620</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Office Staff</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LAB ASSISTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/39"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/39"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/40.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Md. Ahidul Alam</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">41</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01818219048</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Office Staff</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/40"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/40"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/41.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Md. Nurul Islam</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">38</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Office Staff</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/41"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/41"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/42.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Cinta Rani Nath</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">42</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Office Staff</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/42"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/42"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/43.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Mohammad Akkas Meah</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">43</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01861644984</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Office Staff</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/43"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/43"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/no_image.png">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Mohammad Younus</span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">44</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> </font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Office Staff</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">OFFICE ASSISTANT</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/44"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/44"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->
                                        <div class="col-lg-3 col-md-4 col-sm-6 img_div_modal">
                                            <div class="staffinfo-box">
                                                <div class="staffleft-box">
                                                    <img src="http://kajcc.edu.bd/uploads/staff_images/45.jpg">
                                                </div>
                                                <div class="staffleft-content">
                                                    <h5><span data-toggle="tooltip" title="Name" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Rahima Akter </span></h5>
                                                    <p><font data-toggle="tooltip" title="Employee Id" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">30</font></p>
                                                    <p><font data-toggle="tooltip" title="Contact Number" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">01674141033</font></p>
                                                    <p><font data-toggle="tooltip" title="Location" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"></font><font data-toggle="tooltip" title="Department" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing"> FINANCE</font></p>
                                                    <p class="staffsub"><span data-toggle="tooltip" title="Role" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Teacher</span> <span data-toggle="tooltip" title="Designation" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">LECTURER</span></p>
                                                </div>
                                                <div class="overlay3">
                                                    <div class="stafficons">
                                                        }
                                                        <a title="Show" href="http://kajcc.edu.bd/admin/staff/profile/45"><i class="fa fa-navicon"></i></a>
                                                        <a title="Edit" href="http://kajcc.edu.bd/admin/staff/edit/45"><i class=" fa fa-pencil"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--./col-md-3-->


                                    </div>--}}<!--./col-md-3-->
                                    </div><!--./row-->
                                </div><!--./mediarow-->


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#searchByRole').submit(function (e) {
                e.preventDefault();
                var roleId = $('#role_id').val();
                if (roleId > 0) {
                    $.ajax({
                        url: "{{route('fetchStaffByRole')}}",
                        type: "POST",
                        data: {
                            role_id: roleId
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            $('#tbody1').empty();
                            $('#tbody1').html(response.tbody1);
                            $('#cardDiv').empty();
                            $('#cardDiv').html(response.tbody2);
                        }
                    });
                }

            });
            $('#searchByStaff').submit(function (e) {
                e.preventDefault();
                var searchText = $('#search_text').val();
                if (searchText) {
                    $.ajax({
                        url: "{{route('fetchStaffBySearch')}}",
                        type: "POST",
                        data: {
                            search: searchText
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            $('#tbody1').empty();
                            $('#tbody1').html(response.tbody1);
                            $('#cardDiv').empty();
                            $('#cardDiv').html(response.tbody2);
                        }
                    });
                }

            });

            /*function createRows(response) {
                var len = 0;
                $('#studentFeeDiv').show();
                $('#studentTable tbody').empty();
                if (response['students'] != null) {
                    len = response['students'].length;
                }
                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        var classId = response['students'][i].clase.id;
                        var groupId = response['students'][i].group.id;
                        var session = response['session'][0].id;
                        var studentId = response['students'][i].id;
                        var name = response['students'][i].full_name;
                        var admissionNumber = response['students'][i].admission_no;
                        var admissionDate = response['students'][i].admission_date;
                        var roll = response['students'][i].roll_number;
                        var fatherName = response['students'][i].father_name;
                        var tr_str = "<tr>" +
                            "<input type='hidden' value='"+session+"' name='session_id'>"  +
                            "<input type='hidden' value='"+classId+"' name='clase_id'>"  +
                            "<input type='hidden' value='"+groupId+"' name='group_id'>"  +
                            "<input type='hidden' value='"+studentId+"' name='student_id[]'>"+
                            "<td>" + name + "</td>" +
                            "<td>" + admissionNumber + "</td>" +
                            "<td>" + admissionDate + "</td>" +
                            "<td>" + roll + "</td>" +
                            "<td>" + fatherName + "</td>" +
                            "<td>" + "<input type='number' class='form-control' name='amount[]'>" + "</td>" +
                            "</tr>";
                        $("#studentTable").append(tr_str);
                    }
                } else {
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='4' class='color'>No record found.</td>" +
                        "</tr>";

                    $("#studentTable tbody").append(tr_str);
                }
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
