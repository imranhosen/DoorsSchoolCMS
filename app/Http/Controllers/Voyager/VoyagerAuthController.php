<?php

namespace App\Http\Controllers\Voyager;

use App\Models\User;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;

class VoyagerAuthController extends BaseVoyagerAuthController
{
    public function postLogin(Request $request)
    {
        //dd($request->all());

        $this->validate($request,[
            'email' =>'required|email',
            'password' => 'required'
        ]);
        $user_student_id = User::where('email',$request->email)->value('student_id');
        if($user_student_id != null){
            return redirect()->back()->with(['message' => "You have no access to login admin panel!", 'alert-type' => 'error']);
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
        $credentials = $this->credentials($request);
        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request)->with(['message' => "Successfully Logged In!", 'alert-type' => 'success']);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
   /* public function username()
    {
        dd('hi');
        return 'email' || 'name';
    }*/
}