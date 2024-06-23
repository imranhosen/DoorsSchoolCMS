@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">
            <div class="col-md-12">
                @foreach($forms as $form)
                    <p><a href="{{Storage::url((json_decode($form->file))[0]->download_link)}}" target="_blank">
                            {{ $form->file ?: '' }}
                        </a></p>
                @endforeach
            </div>
        </div>
    </div>
@stop
