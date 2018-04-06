<template>
   	<main class="game-wrapper">
		<div class="game-main debate-single">
			<div class="game-header">
				Debate
			</div>
			<debate-header :data="debate"></debate-header>
			<div class="debate-arguments">
				<div class="debate-argument__stream" id="argument-stream">
					<div v-for="argument in debate.arguments">
						<debate-argument :initialArgument="argument" :initialFirstUser="firstUser.id"></debate-argument>
					</div>
				</div>
				<div v-if="checkAds == 1" class="debate-ads">
				<div id="argument-ads" class="debate-ads__stream">
					<a href="#" target="_blank">
						<img data-original="#" class="debate-preview__player-avatar lazy" :src="'/img-dist/ads/'+debate.question.ads.image_url">
					</a>
				</div>
			</div>
				<aside class="game-sidebar game-sidebar__right">
					<div class="game-header" v-text="commentCount"></div>
				</aside>

				<div class="debate-arguments__form" v-if="canArgue">
					<new-debate-argument @argument="addArgument"></new-debate-argument>
				</div>
				<div v-else>
					<debate-comments :data="debate.comments" @created="add"></debate-comments>
				</div>
			</div>
			
	   	</div>
	</main>
</template>

<script>
	import DebateHeader from './DebateHeader.vue';
	import DebateArgument from './DebateArgument.vue';
	import NewDebateArgument from './NewDebateArgument.vue';
	import DebateComments from './DebateComments.vue';
	import Vote from './Vote.vue';
	export default {
		props: ['debate'],
		components: { DebateHeader, DebateArgument, DebateComments, NewDebateArgument, Vote},
		data() {
			return {
				item: this.debate,
				firstUser: this.debate.users[0],
			};
		},
		computed: {
			commentCount() {
				return "Comments (" + _.size(this.item.comments) + ")";
			},
            canArgue() {
                if (!window.Laravel.user) { return false; }
                return this.debate.users.some(function (el) {
				    if (el.id == window.Laravel.user.id) {return true}
				    return false;
				});
            },
			checkAds(){
				if(this.debate.question.ads == null){
					return 0;
				}else{
					return 1;
				}
			}
		},
		methods: {
			add(reply) {
				document.getElementById('comment-stream').scrollTop = 0;
				this.item.comments.unshift(reply);
			},
			addArgument(argument) {
				this.item.arguments.push(argument);
				var stream = document.getElementById("argument-stream");
				stream.scrollTop = stream.scrollHeight;
			}
		}
	}
</script>