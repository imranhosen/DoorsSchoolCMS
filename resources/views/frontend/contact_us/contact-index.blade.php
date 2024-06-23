@extends('frontend.layouts.master')

@section('content')
    <div class="container spacet50 spaceb50">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                       {{-- @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif--}}
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="col-md-6 col-sm-6">
                            <form action="{{route('contact.save')}}" id="open" class="form-horizontal" autocomplete="on"
                                  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                @csrf
                                {{--<input type="hidden" value="contact_us" name="form_name">--}}
                                {{--<input type="hidden" name="email_title" value="New Inquiry from Contact US">--}}
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{old('name')}}" id="name" placeholder="Enter your name"
                                               validation="trim|required|xss_clean" class="form-control">
                                        <span class="text-danger">{{ $errors->first('name') }}</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" value="{{old('email')}}" id="email"
                                                                 placeholder="Enter your email"
                                                                 validation="trim|required|valid_email|xss_clean"
                                                                 class="form-control">
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-9"><input type="number" name="phone" value="{{old('phone')}}" id="phone"
                                                                 placeholder="Enter your Number"
                                                                 validation="trim|required|valid_email|xss_clean"
                                                                 class="form-control">
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="subject" value="{{old('subject')}}" id="subject"
                                               placeholder="Enter subject" validation="trim|required|xss_clean"
                                               class="form-control">
                                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-9"><textarea name="description" cols="40" value="{{old('description')}}" rows="10"
                                                                    id="description"  placeholder="Enter Description"
                                                                    class="form-control"></textarea></div>
                                </div>
                                <div class="form-group"><label for="submit" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-9"><input type="submit"
                                                                 class="btn btn-primary"></div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <iframe
                                src="https://maps.google.com/maps?q=বোরহানগঞ্জ, বোরহানউদ্দিন, ভোলা&t=&z=10&ie=UTF8&iwloc=&output=embed"
                                width="600" height="450"></iframe>
                            <noscript> Full functionality of this site requires JavaScript to be enabled. Learn how to
                                <a href="https://javascriptdownload.org/>Enable JavaScript</a> in your browser.</noscript>
			</div>
		</div>
				<!--./row--></div>
                </div>



            </div><!--./row-->
        </div>
@stop

