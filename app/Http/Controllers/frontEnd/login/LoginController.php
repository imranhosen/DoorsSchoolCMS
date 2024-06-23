<?php

namespace App\Http\Controllers\frontEnd\login;

use App\Http\Controllers\Controller;
use App\Models\FrontCmsNews;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;

class LoginController extends BaseVoyagerAuthController
{
    use AuthenticatesUsers;

    public function login()
    {
        if ($this->guard()->user()) {
            return redirect()->route('voyager.dashboard');
        }
        $news = FrontCmsNews::where('status', 1)->get();
        return view('frontend.user_login.login', compact('news'));
    }

    public function postLogin(Request $request)
    {
        //dd($request->all());
        //$login_id = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        //dd($login_id);

        /*$this->validate($request,[
            'email' =>'required|email',
            'password' => 'required'
        ]);*/
        /* $this->validate($request,[
             'name' =>'required',
             'email' =>'required',
             'password' => 'required'
         ]);*/
/*        if ($login_id == "email") {
            $this->validate($request, [
                'name' => 'required|email',
                'password' => 'required'
            ]);
            $user = User::where('email', $request->name)->value('student_id');
            //dd($user);
            if ($user == null) {
                return redirect()->back()->with(['message' => "You are not a student!", 'alert-type' => 'error']);
            }else{
                if ($this->hasTooManyLoginAttempts($request)) {
                    $this->fireLockoutEvent($request);

                    return $this->sendLockoutResponse($request);
                }

                $credentials = $this->credentials($request);
                //$credentials = $request->only('name', 'password');

                if ($this->guard()->attempt($credentials, $request->has('remember'))) {
                    return $this->sendLoginResponse($request)->with(['message' => "Successfully Logged In!", 'alert-type' => 'success']);
                }

                // If the login attempt was unsuccessful we will increment the number of attempts
                // to login and redirect the user back to the login form. Of course, when this
                // user surpasses their maximum number of attempts they will get locked out.
                $this->incrementLoginAttempts($request);

                return $this->sendFailedLoginResponse($request);
            }
        } else {
            dd('hello');
        }*/

        $user = User::where('email', $request->username)->orWhere('name',$request->username)->value('student_id');
        if ($user == null) {
            return redirect()->back()->with(['message' => "You are not a student!", 'alert-type' => 'error']);
        }
        /*   if($request->email == null){

           }*/
        // $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        $login_id = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
       // dd($login_id);
        if($login_id == "email"){
            $credentials = $request->only('email', 'password');
        }
        if($login_id == "username"){
            $credentials = $request->only('name', 'password');
        }

       // $credentials = $this->credentials($request);
       // $credentials = $request->only('name', 'password');

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request)->with(['message' => "Successfully Logged In!", 'alert-type' => 'success']);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /*
     * Preempts $redirectTo member variable (from RedirectsUsers trait)
     */
    public function redirectTo()
    {
        return config('voyager.user.redirect', route('voyager.dashboard'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(app('VoyagerGuard'));
    }
     public function username()
     {
         //dd('hi');
         $loginValue = \request('username');
         //dd($loginValue);
         $this->username = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
         //$loginId = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
         //dd($loginId);
         \request()->merge([$this->username => $loginValue]);
         return property_exists($this, 'name') ? $this->username : 'email';
         //return 'email' || 'name';
     }
}
