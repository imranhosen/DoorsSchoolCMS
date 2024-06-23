@extends('voyager::master')


@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <h4>Syllabus List</h4>
                            <br>
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="30%">Content Title</th>
                                    <th width="5%">Content Type</th>
                                    <th width="50%">File</th>
                                    <th width="5%">Date</th>
                                    <th width="5%">Available For</th>
                                    <th width="5%">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($syllabuses as $syllabus)
                                    <tr>
                                        <td width="30%">{{ $syllabus->title }}</td>
                                        <td width="5%">{{ $syllabus->contenttypes->content_type }}</td>
                                        <td width="50%"><p><a href="{{Storage::url((json_decode($syllabus->file))[0]->download_link)}}" target="_blank">
                                                    {{ $syllabus->file ?: '' }}
                                                </a></p></td>
                                        <td width="5%">{{ $syllabus->created_at->format("d-m-Y") }}</td>
                                        <td width="5%">{{ $syllabus->classes->name ?? 'No Body' }}({{ $syllabus->groups->name ?? 'No Body' }})</td>
                                        @if($syllabus->status == 0)
                                            <td width="5%"><span class="label label-primary">Deactive</span></td>
                                        @else
                                            <td width="5%"><span class="label label-info">Active</span></td>

                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
            $('#dataTable').DataTable({
                dom: 'Bfrt',
                buttons: [
                    //'copy',
                    {
                        extend: 'excel',
                        messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
                    },
                    {
                        extend: 'pdf',
                        messageBottom: null
                    },
                    /*{
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
            });
        });
    </script>
@stop



