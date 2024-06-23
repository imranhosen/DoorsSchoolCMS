@extends('voyager::auth.master')

@section('content')
    <div class="login-container">

        <p>{{ __('voyager::login.signin_below') }}
                @if(Session::has('message'))
                    <h9 class="alert alert-danger">
                        {{ Session::get('message') }}
                    </h9>
                @endif
           </p>


        <form action="{{ route('voyager.login') }}" method="POST" name="loginForm" onsubmit="return validateForm()">
            {{ csrf_field() }}
            <div class="form-group form-group-default" id="emailGroup">
                <label>{{ __('voyager::generic.email') }}</label>
                <div class="controls">
                    <input type="text" name="email" id="email" value="{{ old('email') }}"
                           placeholder="{{ __('voyager::generic.email') }}" class="form-control" required>
                </div>
                <span class="text-danger">{{$errors->first('email')}}</span>

            </div>

            <div class="form-group form-group-default" id="passwordGroup">
                <label>{{ __('voyager::generic.password') }}</label>
                <div class="controls">
                    <input type="password" name="password" placeholder="{{ __('voyager::generic.password') }}"
                           class="form-control" required>
                    <span class="text-danger">{{$errors->first('password')}}</span>
                </div>
            </div>
            <p class="pull-right"><a href="{{route('voyager.password.request')}}">{{  __('voyager::auth.forgotten_password?') }}</a></p>

            <div class="form-group" id="rememberMeGroup">
                <div class="controls">
                    <input type="checkbox" name="remember" id="remember" value="1"><label for="remember" class="remember-me-text">{{ __('voyager::generic.remember_me') }}</label>
                </div>
            </div>

            <button type="submit" class="btn btn-block login-button" value="Submit">
                <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                <span class="signin">{{ __('voyager::generic.login') }}</span>
            </button>

        </form>

        <div style="clear:both"></div>

        @if(!$errors->isEmpty())
            <div class="alert alert-red">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div> <!-- .login-container -->
@endsection

@section('post_js')
   {{-- <script>
        function validateForm() {
            let x = document.forms["loginForm"]["email"].value;
            //alert(x);
            if (x == null) {
                //alert('hi');
                alert("Email must be filled out");
                //return false;
            }
        }
    </script>--}}

    <script>
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var email = document.querySelector('[name="email"]');
        var password = document.querySelector('[name="password"]');
        btn.addEventListener('click', function(ev){
            var x = document.forms["loginForm"]["email"].value;
            var y = document.forms["loginForm"]["password"].value;

            if (x == "") {
                //alert('hi');
                //alert("Email must be filled out");
                return false;
            }
            if (y == "") {
                //alert('hi');
                //alert("Email must be filled out");
                return false;
            }
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        email.focus();
        document.getElementById('emailGroup').classList.add("focused");

        // Focus events for email and password fields
        email.addEventListener('focusin', function(e){
            document.getElementById('emailGroup').classList.add("focused");
        });
        email.addEventListener('focusout', function(e){
            document.getElementById('emailGroup').classList.remove("focused");
        });

        password.addEventListener('focusin', function(e){
            document.getElementById('passwordGroup').classList.add("focused");
        });
        password.addEventListener('focusout', function(e){
            document.getElementById('passwordGroup').classList.remove("focused");
        });

    </script>
@endsection
