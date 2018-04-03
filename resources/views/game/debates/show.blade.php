<div class="header2">
@extends('layouts.new')
</div>
@section('content')
<div class="marg-top seperate-page-voter">
<?php $now = \Carbon\Carbon::now(); ?>
@if ($now<=$debate->ends_at)
  @if($debate->status == 'needs_opponent')
    <?php $debate_user = (new \App\Helpers\DebateUsers)->get_user($debate->id); ?>
      <div class="btn-set">
      <form method="POST" action="{{ route('joinDebate') }}" id="joinDebate">
        <input type="hidden" name="debate_id" value="{{ $debate->id }}">
        <input type="hidden" id="dbt-arguments" name="debate_argument" value="">
        @if($debate_user->user_id == auth()->user()->id)
          <button type="button" data-toggle="modal" data-target="#mychallengeModal">Challenge</button>
        @else
          <button type="button" data-toggle="modal" data-target="#popupJoinDebate">Join Debate</button>
          <!-- <input type="submit" style="display: none;"> -->

          <!-- <button type="submit"> Join Debate</button> -->
        @endif
      </form>
    </div>
  @endif
 @endif

  @if (Session::has('message'))
    <div class="flash-msg">{{ Session::get('message') }}</div>
  @endif


  <div class="flash-msg" style="display: none;">
    <h4>You voted successfully</h4>
  </div>

  <div class="marginb game-wrapper">


    @if (!Session::has('shareboxdebate'))

      <div class="top-head">
      <div class="debate-preview u-background-white">
        <div class="new-share-sec-debate">

          <div class="share-head">
            <h4 class="u-white-text">Share this Debatel</h4>
            <a href="#" class="shareebate-close"><i class="fa fa-times" aria-hidden="true"></i></a>
          </div>
     
          <p class="debate-preview__question-text">Invite others to this debate to grow the discussion, get more votes, and earn more points. </p>

          <span>Learn more about points and status.</span>
          
          <div class="addthis_inline_share_toolbox"></div>
        
        </div>

      </div>
    </div>
    @endif
 
    <!-- debate component loading -->
    
    <input type="hidden" id="event_type" name="event_type" value="debate_view">
    <input type="hidden" id="event_id" name="event_id" value="{{ $debate->id }}">




    <debate :debate="{{ $debate }}"></debate>

  </div>
  <!-- /.game-wrapper -->



  <div class="modal fade" id="inviteToVote" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
              <h4 class="modal-title">Invite Friend To Vote/Comment</h4>
              <p>Send this debate to a friend who might have something to say.</p>
            </div>
            <div class="modal-footer">
              <button type="button" data-toggle="modal" data-target="#mychallengeModal" data-dismiss="modal">Send to a Friend</button>
              <p data-dismiss="modal">or Cancel</p>
            </div>
          </div>
        </div>
  </div>





  <div class="modal fade" id="mychallengeModal" role="dialog">  
    <div class="modal-dialog">    
      <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div>

          <div class="tab-section">
            <div class="modal-body">
              <h4 class="modal-title"><?=($debate->status == 'needs_opponent')?"Challenge":"Invite"?></h4>
              <p>Select opponents from your network or challenge out to your friends via email.</p>
              <p>Invite as many as you like. First one in gets to debate</p>
            </div>

            <ul class="nav nav-tabs">
              <!-- <li class="active"><a data-toggle="tab" href="#home">Favorites</a></li> -->
              <?php $is_fav_enabled = "0";?>
              @foreach($my_sided_network as $my_sided)
                @if($my_sided->is_favourite =='1')
                <?php $is_fav_enabled = "1"; ?>
                @endif
              @endforeach
              @if($is_fav_enabled =='1')
              <li class="active"><a data-toggle="tab" href="#home">Favorites</a></li>

              @endif

              @if($is_fav_enabled =='0')
                <li class="active"><a data-toggle="tab" href="#menu1">My Sided Network</a></li>
              @else
                <li><a data-toggle="tab" href="#menu1">My Sided Network</a></li>
              @endif
              
              <li><a data-toggle="tab" href="#invite_by_email">Invite Others</a></li>
            </ul>

            <div class="tab-content">
              <!-- tab 1-->
              @if($is_fav_enabled =='1')
              <div id="home" class="tab-pane fade in active">
                <form method="POST" action="{{ route('challengeForDebate') }}" id="challengeForDebate">
                  
                <div class="dashboard-item">
                  <div class="debate-preview u-background-white">
                    <div class="follow-player-sec">

                       @foreach($my_sided_network as $my_sided)
             <?php
                $front_user = DB::table('users')
                        ->where('id', $my_sided->user_id)
                        ->first();
            
                ?>
                        @if($my_sided->is_favourite =='1')
                          <?php
                          $user = App\User::findOrfail($my_sided->user_id);
              if($front_user->is_admin!=1){
                          ?>

                          
                            <div class="debate-preview__players follow-players">

                              <label for="fav{{ $user->id }}">
                              <div class="debate-select-img">
                               <img width="128" height="128" alt="" src="{{ asset('images') }}/{{ $user->avatar_url }}">
                              </div>
                              <div class="debate-select-name">
                                <h4 class="debate-preview__player-name"><a class="u-link-black" href="{{ route('publicPlayerShow',$user->handle) }}" target="_blank"> {{ $user->handle }}</a></h4>
                                  <small> {{ $user->name }} </small>
                              </div>

                              <div class="debate-tick">
                               <input type="checkbox" id="fav{{ $user->id }}" name="invite[]" value="{{ $user->id }}" />
                                <label for="fav{{ $user->id }}"><span></span></label>
                <input type="hidden" name="challenger_name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="take_a_dare_name_{{ $user->id }}" value="{{ $user->name }}">
                              </div>
                              </label>
                            </div>
                          <?php } ?>
                        @endif
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
          <input type="hidden" name="debate_id" value="{{ $debate->id }}">
                  <input type="submit" class="green-btn" value="Confirm">
                  <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                </div>

                </form>
              </div>

               @endif

              
              <!-- tab 2-->
              @if($is_fav_enabled =='0')
                  <div id="menu1" class="tab-pane fade in active">
                  
                @else
                  <div id="menu1" class="tab-pane fade">

                @endif
                <form method="POST" action="{{ route('challengeForDebate') }}" id="challengeForDebate">

                  <div class="dashboard-item">
                    <div class="debate-preview u-background-white">
                    
                        <div class="follow-player-sec">
                        <?php $hasFollowers = 0; ?>
                        @foreach($my_sided_network as $my_sided)
                          <?php
                            $front_user = DB::table('users')
                                        ->where('id', $my_sided->user_id)
                                        ->first();
                            
                          ?>
                          @if($my_sided->status =='follow')
                            <?php
                              $user = App\User::findOrfail($my_sided->user_id);
                              if($front_user->is_admin!=1){
                                $hasFollowers = 1; 
                            ?>
                              <div class="debate-preview__players follow-players">  
                                <label for="{{ $user->id }}">
                                  <div class="debate-select-img">
                                  <img width="128" height="128" alt="" src="{{ asset('images') }}/{{ $user->avatar_url }}">
                                </div>
                                <div class="debate-select-name">
                                  <h4 class="debate-preview__player-name"><a class="u-link-black" href="{{ route('publicPlayerShow',$user->handle) }}"> {{ $user->handle }}</a></h4>
                                    <small> {{ $user->name }} </small>
                                </div>

                              <div class="debate-tick">
                               <input type="checkbox" id="{{ $user->id }}" name="invite[]" value="{{ $user->id }}" />
                                <label  for="{{ $user->id }}"><span></span></label>
                                <input type="hidden" name="challenger_name" value="{{ Auth::user()->name }}">
                                  <input type="hidden" name="take_a_dare_name_{{ $user->id }}" value="{{ $user->name }}">
  
                                </div>
                              </div>
                            <?php } ?>
                          @endif
                        @endforeach
                        @if($hasFollowers == 0)
                        <p>No one added in my sided network.</p>
                        <button type="button" data-toggle="modal" data-target="#popupFollowUsers" data-backdrop="static" data-keyboard="false" id="show-followers-popup" data-dismiss="modal">Follow Users</button>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="debate_id" value="{{ $debate->id }}">
                    <input type="submit" class="green-btn" value="Confirm">
                    <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                  </div>
                </form>
              </div>

              <!-- tab 3-->
              <div id="invite_by_email" class="tab-pane fade">
                <div class="sided-net-content">
                  <h4 class="modal-title">Invite by Email</h4>
                  <p>Add the email addresses of up to three friends you want to debate. We'll invite them into the ring.</p>
                  <div class="email-address-form">
                    <form name="invite_email" action="{{ route('inviteInner') }}" method="post">

                      <div class="dashboard-item">

                        <input type="email" placeholder="Your friends email address…"  name="email[]">
                        <input type="email" placeholder="Your friends email address…" name="email[]">
                        <input type="email" placeholder="Your friends email address…" name="email[]">
                      </div>

                      <div class="modal-footer">
                          <input type="hidden" name="debate_id" value="{{ $debate->id }}">
                          <input type="submit" class="green-btn" value="Confirm">
                          <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
              <!-- tab 3-->
          </div>
        </div>
      </div>
    </div>
  </div>



    <div class="modal fade" id="popupJoinDebate" role="dialog">  
      <div class="modal-dialog">   

        <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            
            <div class="modal-body">
              <h4 class="modal-title"></h4>
              <p>You are about to join debate, please confirm.</p>
              <textarea name="join_debate_argument" id="join-debate-argument"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="join-submit-btn" disabled>Yes</button>
              <p data-dismiss="modal">No</p>
            </div>


          </div>
        </div>
    </div>
  </div>


<div class="modal fade" id="mychallengeModal" role="dialog">  
    <div class="modal-dialog">    
      <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div>

          <div class="tab-section">
            <div class="modal-body">
              <h4 class="modal-title"><?=($debate->status == 'needs_opponent')?"Challenge":"Invite"?></h4>
              <p>Select opponents from your network or challenge out to your friends via email.</p>
              <p>Invite as many as you like. First one in gets to debate</p>
            </div>

            <ul class="nav nav-tabs">
              <!-- <li class="active"><a data-toggle="tab" href="#home">Favorites</a></li> -->
              <?php $is_fav_enabled = "0";?>
              @foreach($my_sided_network as $my_sided)
                @if($my_sided->is_favourite =='1')
                <?php $is_fav_enabled = "1"; ?>
                @endif
              @endforeach
              @if($is_fav_enabled =='1')
              <li class="active"><a data-toggle="tab" href="#home">Favorites</a></li>

              @endif

              @if($is_fav_enabled =='0')
                <li class="active"><a data-toggle="tab" href="#menu1">My Sided Network</a></li>
              @else
                <li><a data-toggle="tab" href="#menu1">My Sided Network</a></li>
              @endif
              
              <li><a data-toggle="tab" href="#invite_by_email">Invite Others</a></li>
            </ul>

            <div class="tab-content">
              <!-- tab 1-->
              @if($is_fav_enabled =='1')
              <div id="home" class="tab-pane fade in active">
                <form method="POST" action="{{ route('challengeForDebate') }}" id="challengeForDebate">
                  
                <div class="dashboard-item">
                  <div class="debate-preview u-background-white">
                    <div class="follow-player-sec">

                       @foreach($my_sided_network as $my_sided)
             <?php
                $front_user = DB::table('users')
                        ->where('id', $my_sided->user_id)
                        ->first();
            
                ?>
                        @if($my_sided->is_favourite =='1')
                          <?php
                          $user = App\User::findOrfail($my_sided->user_id);
              if($front_user->is_admin!=1){
                          ?>

                          
                            <div class="debate-preview__players follow-players">

                              <label for="fav{{ $user->id }}">
                              <div class="debate-select-img">
                               <img width="128" height="128" alt="" src="{{ asset('images') }}/{{ $user->avatar_url }}">
                              </div>
                              <div class="debate-select-name">
                                <h4 class="debate-preview__player-name"><a class="u-link-black" href="{{ route('publicPlayerShow',$user->handle) }}" target="_blank"> {{ $user->handle }}</a></h4>
                                  <small> {{ $user->name }} </small>
                              </div>

                              <div class="debate-tick">
                               <input type="checkbox" id="fav{{ $user->id }}" name="invite[]" value="{{ $user->id }}" />
                                <label for="fav{{ $user->id }}"><span></span></label>
                <input type="hidden" name="challenger_name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="take_a_dare_name_{{ $user->id }}" value="{{ $user->name }}">
                              </div>
                              </label>
                            </div>
                          <?php } ?>
                        @endif
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
          <input type="hidden" name="debate_id" value="{{ $debate->id }}">
                  <input type="submit" class="green-btn" value="Confirm">
                  <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                </div>

                </form>
              </div>

               @endif

              
              <!-- tab 2-->
              @if($is_fav_enabled =='0')
                  <div id="menu1" class="tab-pane fade in active">
                  
                @else
                  <div id="menu1" class="tab-pane fade">

                @endif
                <form method="POST" action="{{ route('challengeForDebate') }}" id="challengeForDebate">

                  <div class="dashboard-item">
                    <div class="debate-preview u-background-white">
                        <div class="follow-player-sec">
                        @foreach($my_sided_network as $my_sided)
                          <?php
                            $front_user = DB::table('users')
                                        ->where('id', $my_sided->user_id)
                                        ->first();
                            
                          ?>
                          @if($my_sided->status =='follow')
                            <?php
                              $user = App\User::findOrfail($my_sided->user_id);
                              if($front_user->is_admin!=1){
                            ?>
                              <div class="debate-preview__players follow-players">  
                                <label for="{{ $user->id }}">
                                  <div class="debate-select-img">
                                  <img width="128" height="128" alt="" src="{{ asset('images') }}/{{ $user->avatar_url }}">
                                </div>
                                <div class="debate-select-name">
                                  <h4 class="debate-preview__player-name"><a class="u-link-black" href="{{ route('publicPlayerShow',$user->handle) }}"> {{ $user->handle }}</a></h4>
                                    <small> {{ $user->name }} </small>
                                </div>

                              <div class="debate-tick">
                               <input type="checkbox" id="{{ $user->id }}" name="invite[]" value="{{ $user->id }}" />
                                <label  for="{{ $user->id }}"><span></span></label>
                                <input type="hidden" name="challenger_name" value="{{ Auth::user()->name }}">
                                  <input type="hidden" name="take_a_dare_name_{{ $user->id }}" value="{{ $user->name }}">
  
                                </div>
                              </div>
                            <?php } ?>
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="debate_id" value="{{ $debate->id }}">
                    <input type="submit" class="green-btn" value="Confirm">
                    <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                  </div>
                </form>
              </div>

              <!-- tab 3-->
              <div id="invite_by_email" class="tab-pane fade">
                <div class="sided-net-content">
                  <h4 class="modal-title">Invite by Email</h4>
                  <p>Add the email addresses of up to three friends you want to debate. We'll invite them into the ring.</p>
                  <div class="email-address-form">
                    <form name="invite_email" action="{{ route('inviteInner') }}" method="post">

                      <div class="dashboard-item">

                        <input type="email" placeholder="Your friends email address…"  name="email[]">
                        <input type="email" placeholder="Your friends email address…" name="email[]">
                        <input type="email" placeholder="Your friends email address…" name="email[]">
                      </div>

                      <div class="modal-footer">
                          <input type="hidden" name="debate_id" value="{{ $debate->id }}">
                          <input type="submit" class="green-btn" value="Confirm">
                          <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
              <!-- tab 3-->
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
<div id="popupFollowUsers" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close closed-follow-popup" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Follow Users</h4>
      </div>
      <div class="modal-body">
      @foreach($followUsers as $user)
        <div class="debate-preview__players follow-players">
          <div class="debate-follow-img">
            <img src="{{ asset('/images/'.$user->avatar_url) }}" width="128" height="128" alt="">
          </div>
          <div class="debate-follow-name">
            <h4 class="debate-preview__player-name"><a href="{{ route('publicPlayerShow', $user->handle) }}" class="u-link-black">{{ $user->name }}</a></h4>
            <small> {{  $user->handle }} </small>
          </div> 
          <div class="debate-follow-btn"><button value="{{ $user->id }}" class="follow-btn">Follow</button></div>
        </div>
      @endforeach
      </div>
    </div>

  </div>
</div>
  
@endsection