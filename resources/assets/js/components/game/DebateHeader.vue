<template>
	<div class="debate-preview u-background-white">
	    <div class="debate-preview__header">
			<div class="debate-haeder-top">
				<h4 class="debate-preview__category">
					Submitted In <strong class="u-text-black">{{ debate.question_category }}</strong>
					<span v-if="Date.now() < new Date(debate.question.expire_at)">{{ debate.question.publish_at | timeago }}</span>
					<span v-else>Closed</span>
				</h4>
				<h4 class="debate-preview__category">
					Submitted By <strong class="u-text-black"><a :href="'/players/' + debate.get_debatequestion.getquestion_auther.handle" target="_blank">{{ debate.get_debatequestion.getquestion_auther.name }}</a></strong>

				</h4>
				
				<span v-if="debate.status !='active'" data-toggle="modal" data-target="#myModal3" class="send-debate">
					<img src="/img/dot.svg">
				</span>
				<span v-else data-toggle="modal" data-target="#inviteToVote" class="send-debate">
					<img src="/img/dot.svg">
				</span>
	        </div>
			<p class="debate-preview__question-text">
	            {{ debate.question_text }}
	        </p>
	        <small class="debate-preview__question-source">
	            {{ debate.question_medium }} from <strong class="u-text-black">{{ debate.question_source }}</strong>
	        </small>
	    </div>
	    <div class="debate-preview__players u-flex">
            <div v-for="user in debate.users" class="debate-preview__player u-flex-center">
                <div class="debate-preview__player-img">
                    <a href="/players/">
                        <img class="debate-preview__player-avatar" :src="user.avatar_url" :alt="user.name">
                    </a>
                </div>
                <div class="debate-preview__player-info">
                    <h4 class="debate-preview__player-name">
                    <a class="u-link-black" :href="'/players/' + debate.get_debatequestion.getquestion_auther.handle" target="_blank">
                            {{ user.handle }}
                        </a>
                    </h4>
                    <small>
                        {{ user.rank }}
                    </small>
                </div><!-- /player-info-->
				<ul v-if="user.pivot.votes > 0" :class="'voter-sec full-dark vote-count-'+user.pivot.votes+'-my-debate my-debate'">
					<li v-if="debate.users[0].id == user.id">
						<span>{{ user.pivot.votes }}</span>
						<a v-if="debate.users.id == user.id" href="javascript:void(0)" :data-debate-id="debate.id" :data-user-id="user.id" :data-debate-status="debate.status" :id="debate.status == 'active' ? 'vote_for_debate': ''" :title="'Click to Vote for '+user.name" :style="debate.status =='active' ? 'cursor:pointer' : 'cursor:default'" :class="'my-debate-'+user.pivot.side.toLowerCase()+'-1'">
							<img src="/img/left-vote-btn.svg" alt="Jitendra">
						</a>
						<a v-else href="javascript:void(0)" :data-debate-id="debate.id" :data-user-id="user.id" :data-debate-status="debate.status" :id="debate.status == 'active' ? 'vote_for_debate': ''" :title="'Click to Vote for '+user.name" :style="debate.status =='active' ? 'cursor:pointer' : 'cursor:default'" :class="'not-my-debate-'+user.pivot.side.toLowerCase()+'-1'">
							<img src="/img/left-vote-btn.svg" alt="Jitendra">
						</a>
					</li>
					<li v-else>
						<a v-if="debate.users.id == user.id" href="javascript:void(0)" :data-debate-id="debate.id" :data-user-id="user.id" :data-debate-status="debate.status" :id="debate.status == 'active' ? 'vote_for_debate': ''" :title="'Click to Vote for '+user.name" :style="debate.status =='active' ? 'cursor:pointer' : 'cursor:default'" :class="'my-debate-'+user.pivot.side.toLowerCase()+'-2'">
							<img src="/img/left-vote-btn.svg" alt="Jitendra">
						</a>
						<a v-else href="javascript:void(0)" :data-debate-id="debate.id" :data-user-id="user.id" :data-debate-status="debate.status" :id="debate.status == 'active' ? 'vote_for_debate': ''" :title="'Click to Vote for '+user.name" :style="debate.status =='active' ? 'cursor:pointer' : 'cursor:default'" :class="'not-my-debate-'+user.pivot.side.toLowerCase()+'-2'">
							<img src="/img/left-vote-btn.svg" alt="Jitendra">
						</a>
						<span>{{ user.pivot.votes }}</span>
					</li>
				</ul><!-- vote info -->
				<ul v-else :class="'voter-sec full-dark vote-count-'+user.pivot.votes+'-my-debate-disabled my-debate-disabled'">
					<li v-if="debate.users[0].id == user.id">
						<span>{{ user.pivot.votes }}</span>
						<a v-if="debate.users.id == user.id" href="javascript:void(0)" :data-debate-id="debate.id" :data-user-id="user.id" :data-debate-status="debate.status" :id="debate.status == 'active' ? 'vote_for_debate': ''" :title="'Click to Vote for '+user.name" :style="debate.status =='active' ? 'cursor:pointer' : 'cursor:default'" :class="'my-debate-'+user.pivot.side.toLowerCase()+'-1'">
							<img src="/img/left-vote-btn.svg" alt="Jitendra">
						</a>
						<a v-else href="javascript:void(0)" :data-debate-id="debate.id" :data-user-id="user.id" :data-debate-status="debate.status" :id="debate.status == 'active' ? 'vote_for_debate': ''" :title="'Click to Vote for '+user.name" :style="debate.status =='active' ? 'cursor:pointer' : 'cursor:default'" :class="'not-my-debate-'+user.pivot.side.toLowerCase()+'-1'">
							<img src="/img/left-vote-btn.svg" alt="Jitendra">
						</a>
					</li>
					<li v-else>
						<a v-if="debate.users.id == user.id" href="javascript:void(0)" :data-debate-id="debate.id" :data-user-id="user.id" :data-debate-status="debate.status" :id="debate.status == 'active' ? 'vote_for_debate': ''" :title="'Click to Vote for '+user.name" :style="debate.status =='active' ? 'cursor:pointer' : 'cursor:default'" :class="'my-debate-'+user.pivot.side.toLowerCase()+'-2'">
							<img src="/img/left-vote-btn.svg" alt="Jitendra">
						</a>
						<a v-else href="javascript:void(0)" :data-debate-id="debate.id" :data-user-id="user.id" :data-debate-status="debate.status" :id="debate.status == 'active' ? 'vote_for_debate': ''" :title="'Click to Vote for '+user.name" :style="debate.status =='active' ? 'cursor:pointer' : 'cursor:default'" :class="'not-my-debate-'+user.pivot.side.toLowerCase()+'-2'">
							<img src="/img/left-vote-btn.svg" alt="Jitendra">
						</a>
						<span>{{ user.pivot.votes }}</span>
					</li>
				</ul><!-- vote info -->
            </div>

			<div v-if="debate.status == 'needs_opponent'" class="debate-preview__player u-flex-center "><div class="debate-preview__player-img disagree"><a href="#" data-target="#mychallengeModal" data-toggle="model" onclick="openpopup()"><img src="http://localhost/images/user_icon.png" class="debate-preview__player-avatar"></a></div> <div href="#" data-target="#mychallengeModal" data-toggle="model" onclick="openpopup()" style="cursor:pointer" class="debate-preview__player-info"><h4 class="debate-preview__player-name"><span class="u-link-black non-active">
Waiting for
</span></h4> <span class="u-link-black non-active">
Opponent
</span></div><ul class="voter-sec"><li><a class="disable-vote-icon"><img src="http://localhost/img/right-vote-btn.svg" class="debate-preview__player-avatar"></a></li></ul></div>
	    </div><!-- debate-preview__players-->
	</div><!-- /debate-preview-->
</template>


<script>
	export default {
		props: ['data'],
		data() {
			return {
				debate: this.data,
				vote_side: 0
			}
		},
	}
</script>