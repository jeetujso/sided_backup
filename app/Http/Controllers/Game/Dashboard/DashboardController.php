<?php

namespace App\Http\Controllers\Game\Dashboard;

use App\Activity;
use App\Debate;
use App\Question;
use App\User;
use App\Follower;
use App\DebateCategory;
use App\Ad;
use App\DebateCategoryUser;
use Carbon\Carbon;
use Auth;
use Exception;
use Session;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('onboarded');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        try{
            $expired = Question::where('expire_at','<',Carbon::now())->get();
            foreach($expired as $expire){
                // update debate status where question id = exired question id
                Debate::where('question_id', $expire->id)
                        ->where('status', 'active')
                        ->update(['status'=>'closed']);
            }
          
           // $myCategories = DebateCategoryUser::groupBy('category_id')->pluck('category_id')->where('user_id',Auth::user()->id)->all();
            $myCategories = DebateCategoryUser::where('user_id',Auth::user()->id)->pluck('category_id')->toArray();
            $catAssociatedQuestionId = Question::whereIn('category_id', $myCategories)->pluck('id')->toArray();
        
            $debates = Debate::whereIn('question_id', $catAssociatedQuestionId)->where('starts_at', '<=', Carbon::now())->where([['ends_at', '>=', Carbon::now()], ['status', '!=', 'completed'],])->orderby('created_at', 'desc')->get();
           
            $usedQuesIds = Debate::groupBy('question_id')->pluck('question_id')->all();
            $questions = Question::with('category')->whereIn('category_id', $myCategories)->publicLive()->whereNotIn('id', $usedQuesIds)->take('10')->get();
            
            //$activities = Activity::all();            
            $obj_user = new User();
            $follow_suggestions = $obj_user->follow_suggestion(auth()->user()->id);
            $prousers = $obj_user->where('is_admin', 1)->get();
            $active_users = $obj_user->where('is_admin', '1')->where('id', '!=', auth()->user()->id)->take(6)->get();
            
            $obj_category = new DebateCategory();
            $categories = $obj_category->where('status','live')->get();

            $ads = Ad::dashboardAds()->get();

            return view('game.dashboard.index', compact('questions', 'debates', 'follow_suggestions','categories','active_users','prousers','ads'));

        }catch(Exception $e){
            $msg = $e->getMessage();
            return view('errors.404', compact('msg'));
        }
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
    public function store(Request $request)
    {
        //
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



    public function load_follow_suggestion(){
        $user = new User();
        $follow_suggestions = $user->follow_suggestion(auth()->user()->id);
        if(count($follow_suggestions) > 0){
            return response()->json(['response_code'=>'1', 'response'=>$follow_suggestions, 'status'=>'success']);  

        }else{
            return response()->json(['response_code'=>'0', 'response'=>'No more suggesstion.', 'status'=>'success']);    
        }
    }



    public function share_box(){
        Session::put('sharebox', 'hidden');
        return response()->json(['response_code'=>'0', 'response'=>'hidden', 'status'=>'success']);  
    }    
}
