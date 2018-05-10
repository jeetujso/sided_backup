<?php $side=""; ?>
            <div class="debate-preview u-background-white">

                <div class="debate-preview__header">
                    <div class="debate-haeder-top">
                        <h4 class="debate-preview__category"> Submitted In <strong class="u-text-black">{{ $debate->question->category->name }}</strong></h4>
						
                        <!-- <span><img src="img/dot.svg" alt=""></span> -->
						<h5 class="debate-preview__category">Submitted By <strong class="u-text-black"><a href="{{ route('publicPlayerShow', $debate->getDebatequestion->getquestionAuther->handle ) }}">{{ $debate->getDebatequestion->getquestionAuther->name }}</a></strong></h5>
                    </div>
					
                    <p class="debate-preview__question-text">{{$debate->question->text }}</p>

                    <small class="debate-preview__question-source <?=(empty($debate->question->source))?'source-hidden':''?>">{{$debate->question->medium }} from <strong class="u-text-black">{{$debate->question->source }}</strong></small>
                </div>

                <!-- Players -->
                <div class="debate-preview__players u-flex">


                    @foreach ($debate->users()->get() as $user)
                        <?php $side = strtolower((new \App\Helpers\Debates)->getDebateUserSide($debate->id, $user->id)->side); 
                        ?>
                        <?php if(!isset($side)){ $side= ''; }?>
                        <div class="debate-preview__player u-flex-center">
                            <div class="debate-preview__player-img  <?php echo $side; ?>">
                                    
                                    <a href="{{ route('publicPlayerShow', $user->handle) }}"><img class="debate-preview__player-avatar" src="{{ asset('images') }}/{{ $user->avatar_url }}" alt="{{ $user->name }}"></a>
                            </div>
                            <div class="debate-preview__player-info">
                                <h4 class="debate-preview__player-name">
                                    <a href="{{ route('publicPlayerShow', $user->handle) }}" class="u-link-black"> {{ $user->handle }} </a>
                                </h4>
                                <small>{{ $user->rank }}</small>
                            </div><!-- /player-info-->

                            <ul class="voter-sec">
                                <li><span></span><img src="{{ asset('/img/left-vote-btn-dark.svg') }}"></li>
                            </ul>

                        </div>
                    @endforeach
                    @if($side =='agree')
                        <?php $opponent_side = 'disagree'; ?>
                    @else
                        <?php $opponent_side = 'agree'; ?>
                    @endif

                    <div class="debate-preview__player u-flex-center">
                        <div class="debate-preview__player-img {{ $opponent_side }}">
                            <a href="#"><img src="{{ asset('images/user.svg') }}" alt="" class="debate-preview__player-avatar"></a>
                        </div>
                        <div multilinks-noscroll="true" class="debate-preview__player-info">
                            <h4 multilinks-noscroll="true" class="debate-preview__player-name">
                                
                                <a onclick="return false" class="u-link-black non-active">Waiting for<br>Opponent</a>
                            </h4>
                            <small></small>
                        </div>

                        <ul class="voter-sec">
                            <li><span></span><img src="{{ asset('/img/right-vote-btn-dark.svg') }}"><span></span></li>
                        </ul>
                    </div>

                </div>
            </div>