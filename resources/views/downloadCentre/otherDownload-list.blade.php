@extends('voyager::master')
@section('css')
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <h4>Other Download List</h4>
                            <br>
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Content Title</th>
                                    <th>Content Type</th>
                                    <th>Date</th>
                                    <th>Available For</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($otherDownloads as $otherDownload)
                                    <tr>
                                        <td>{{ $otherDownload->title }}</td>
                                        <td>{{ $otherDownload->contenttypes->content_type }}</td>
                                        <td>{{ $otherDownload->created_at->format("d-m-Y") }}</td>
                                        <td>{{ $otherDownload->classes->name ?? 'No Body' }}({{ $otherDownload->groups->name ?? 'No Body'}})</td>
                                        @if($otherDownload->status == 0)
                                            <td><span class="label label-primary">Deactive</span></td>
                                        @else
                                            <td><span class="label label-info">Active</span></td>

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



