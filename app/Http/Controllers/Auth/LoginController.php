<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

	public function login(Request $request)
	{
		$this->validateLogin($request);

		$user = User::where('email', $request->email)->firstOrFail();
		if ( $user && $user->blocked ) {
			return $this->sendLockedAccountResponse($request);
		}

		if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}

		if ($this->attemptLogin($request)) {
			return $this->sendLoginResponse($request);
		}

		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
	}


	protected function sendLockedAccountResponse(Request $request)
	{
		return redirect()->back()
		                 ->withInput($request->only($this->username(), 'remember'))
		                 ->with('blockedMessage','Your account is blocked!');
	}



	protected function redirectTo(){
		if(Auth::user()->userRole == 'admin'){

			return 'admin/dashboard';

		} else{

			return 'user/home';
		}
	}

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
