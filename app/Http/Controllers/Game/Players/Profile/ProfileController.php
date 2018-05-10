<?php

namespace App\Http\Controllers\Game\Players\Profile;
use Twilio;

use App\User;

use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
//use Image;

class ProfileController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $id)
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
        //die('kk');
        // profile edit page
        return view('game.players.profile.edit');
        
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
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $id = auth()->id();
        $User = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'phone_number' => 'required',
            'handle' => [
                'required',
                Rule::unique('users')->ignore($id),
                'regex:/^[a-zA-Z0-9_.]*$/'
            ]
        ]);
 
        $input = $request->all();
        if( $request->hasFile('avatar_url') ) {
            $image = $request->file('avatar_url');
            $input['avatar_url'] = time().'.'.$image->getClientOriginalExtension();

            // $destinationPath = public_path('/images/thumbnail');
            // $thumb_img = Image::make($image->getRealPath())->resize(80, 80);
            // $thumb_img->save($destinationPath.'/'.$input['avatar_url']);

            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['avatar_url']);
        }
       
        if($User->phone_number == $request->get('phone_number')){
            $User->fill($input)->save();
            return \Redirect::back()->withSuccess( 'Details Successfully updated' );
        }else{
            $otp = rand(1000,9999);
            $input['otp'] = $otp;
            $User->fill($input)->save();

            $accountId = 'AC3933d1348280d77b0a52ff390f37ec51'; 
            $token = '4a92784fca737d65787620b833e732c0'; 
            $fromNumber = '+17246095092';
            $twilio = new \Aloha\Twilio\Twilio($accountId, $token, $fromNumber);
            $twilio->message($request->get('phone_number'), $otp);

            //return \Redirect::back()->withSuccess( 'Details Successfully updated' );
            return redirect()->route('frontMobileOtp');
        }
        
    }

    public function otp(){
        return view('game.players.profile.otp-verification');
    }
    public function editProfileResentOtp()
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
        return redirect()->route('frontMobileOtp');
    }
    public function validateOtp(Request $request)
    {
        $user = Auth::user();
        if($user->otp == $request->get('otp')){
            $user->update([
                'otp' => 1
            ]);
            return redirect('/players/profile/'.$user->id.'/edit')->withSuccess( 'Details Successfully updated' );;
        }else{
            return redirect()->back()->withErrors(['msg', 'Otp not matched']);
        }
        //return view('game.onboarding.phone-otp', ['user' => Auth::user()]);
        //return redirect()->route('onboardingCategoryCreate');
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
