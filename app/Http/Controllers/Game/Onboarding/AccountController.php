<?php

namespace App\Http\Controllers\Game\Onboarding;
use Twilio;
use App\User;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Game\Onboarding\AccountCreate;

class AccountController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('game.onboarding.account', ['user' => Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountCreate $request)
    {
       
        $user = Auth::user();
        $otp = rand(1000,9999);
        $user->update([
            'email' => $request->email,
            'handle' => $request->handle,
            'phone_number' => $request->pn,
            'otp' => $otp
        ]);
        $accountId = 'AC3933d1348280d77b0a52ff390f37ec51'; 
        $token = '4a92784fca737d65787620b833e732c0'; 
        $fromNumber = '+17246095092';
        $twilio = new \Aloha\Twilio\Twilio($accountId, $token, $fromNumber);
        $twilio->message($request->pn, $otp);
       // return redirect()->route('onboardingCategoryCreate');
       return redirect()->route('onboardingMobileOtp');
       
    }
    public function otp()
    {
        $user = Auth::user();
        return view('game.onboarding.phone-otp', ['user' => Auth::user()]);
        //return redirect()->route('onboardingCategoryCreate');
    }
    public function resentOtp()
    {
        $user = Auth::user();
        $otp = rand(1000,9999);
        $user->update([
            'otp' => $otp
        ]);
        $accountId = 'AC3933d1348280d77b0a52ff390f37ec51'; 
        $token = '4a92784fca737d65787620b833e732c0'; 
        $fromNumber = '+17246095092';
        $twilio = new \Aloha\Twilio\Twilio($accountId, $token, $fromNumber);
        $twilio->message($user->phone_number, $otp);
        return redirect()->route('onboardingMobileOtp');
    }
    public function validateOtp(Request $request)
    {
        $user = Auth::user();
        if($user->otp == $request->otp){
            $user->update([
                'otp' => 1
            ]);
            return redirect()->route('onboardingCategoryCreate');
        }else{
            return redirect()->back()->withErrors(['msg', 'Otp not matched']);
        }
        //return view('game.onboarding.phone-otp', ['user' => Auth::user()]);
        //return redirect()->route('onboardingCategoryCreate');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
