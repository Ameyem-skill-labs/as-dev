<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
// use App\Http\Controllers\Auth\Request;
use Illuminate\Http\Request;

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

    protected function attemptLogin(Request $request)
    {
        // 
        // return $this->guard()->attempt(
        //     $this->credentials($request), $request->filled('remember')
        // );

        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            //user sent their email 
            return $this->guard()->attempt(['email' => $request->email, 'password' => $request->password]
            , $request->filled('remember'));
        } else {
            //they sent their username instead 
            return $this->guard()->attempt(['name' => $request->email, 'password' => $request->password]
            , $request->filled('remember'));
        }
    }
// protected function authenticated(Request $request, $user)
// {
// // if ( $user->isAdmin() ) {// do your margic here
// //     return redirect()->route('dashboard');
// // }
// // if ( $user->isAdmin() ) {// do your margic here
// //     return redirect()->route('dashboard');
// // }
// //  return redirect('/home');
// }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest', ['except' => 'logout']);
    // }

    // or in AuthController constructor add

public function __construct()
{
    $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
}

    /**
     * Logout, Clear Session, and Return.
     *
     * @return void
     */
    public function logout()
    {
        // return "Clicked logout";
        $user = Auth::user();
        // Log::info('User Logged Out. ', [$user]);
        Auth::logout();
    //     return 
    //    Session::all();
        
        Session::flush();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
