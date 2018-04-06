<template>
	<div class="debate-preview u-background-white">
	    <div class="debate-preview__header">
			<div class="debate-haeder-top">
				<h4 class="debate-preview__category">
					Submitted In <strong class="u-text-black">{{ debate.question_category }}</strong>
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
                        <a class="u-link-black" href="/players/">
                            {{ user.handle }}
                        </a>
                    </h4>
                    <small>
                        {{ user.rank }}
                    </small>
                </div><!-- /player-info-->
            </div>
	    </div><!-- debate-preview__players-->
	</div><!-- /debate-preview-->
</template>


<script>
	export default {
		props: ['data'],
		data() {
			return {
				debate: this.data
			}
		},
	}
</script>