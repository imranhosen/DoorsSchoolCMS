@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">

            <div class="col-md-12" style="text-align: center">
                @foreach($book_lists as $book_list)
                    <p><a href="{{Storage::url((json_decode($book_list->file))[0]->download_link)}}" target="_blank">
                            {{ $book_list->file ?: '' }}
                        </a></p>
                @endforeach
            </div>
        </div>
    </div>
@stop
