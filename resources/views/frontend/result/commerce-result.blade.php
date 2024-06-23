@extends('frontend.layouts.master')

@section('content')
    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">
            <div class="col-md-12">
                @foreach($results as $result)
                    <p><b>{{$result->title}}</b></p>
                    <p><a href="{{Storage::url((json_decode($result->file))[0]->download_link)}}" target="_blank">
                            {{ $result->file ?: '' }}
                        </a></p>
                @endforeach
            </div>
        </div>
    </div>
@stop

