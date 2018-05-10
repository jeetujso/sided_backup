<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/feed';

    public function showLoginForm(Request $request)
   {
    //$ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    //echo $ref;
    //exit;
     //$previous_url = Session::get('_previous.url');
    // echo $previous_url;
    // exit;
        // $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        // $ref = rtrim($ref, '/');
        // if ($previous_url != url('login')) {
        //     Session::put('referrer', $ref);
        //     if ($previous_url == $ref) {
        //         Session::put('url.intended', $ref);
        //     }
        // }
       // $request->session()->put('url.intended',URL::previous());
       // $request->session()->flush();
        // echo "<pre>";
        // echo app('Illuminate\Routing\UrlGenerator')->previous();
        // //print_r(Input::get('utm_source'));
        // exit;
       return view('auth.login');
   }
    // public function login(Request $request){
    //     echo $request->session()->get('url.intended');
    //     $request->session()->flush();
    //     exit;
    //     $email = $request->get('email');
    //     $password = $request->get('password');
    //      if (Auth::attempt(['email' => $email, 'password' => $password])) {
    //         // Authentication passed...
    //         if(Auth::user()->is_admin == 1){
    //             return redirect()->intended('/partners/questions/activities');
    //         }else{
    //              return redirect()->intended('/feed');
    //         }
    //     }
    // }
    protected function authenticated(Request $request, $user)
    {
       //echo Session::pull('referrer');
       //exit;
        // echo "<pre>";
        // print_r($request->all());
        // exit;

        if($user->is_admin == 1){
            //return redirect()->route('partnerQuestionActivity');
            return redirect()->intended('/partners/questions/activities');
        }else{
            //return redirect()->route('publicDashboardIndex');
            return redirect()->intended('/feed');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        // $ref = rtrim($ref, '/');
        $this->middleware('guest')->except('logout');
    }
}
