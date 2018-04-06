<template>
	<div class="debate-comments u-background-white">
		<div class="debate-comment__stream" id="comment-stream">
			<div class="debate-comment" v-for="reply in items">
				<div class="debate-comment__message">
					{{ reply.comment }}
				</div>
				<div class="debate-comment__author">
					Posted by {{ reply.user.handle }} {{ reply.created_at | dateAgo}}
				</div>
			</div>
		</div><!-- /debate-comment__stream -->
		<div class="debate-comment__form">
			<input type="text" class="form-control resp-text-box" name="comment" placeholder="What do you think?" required autofocus v-model="body">
			<button type="submit"
				class="hide"
				@click="addComment">Post Comment</button>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['data'],
		data() {
			return {
				body: "",
				items: this.data
			}
		},
		methods: {
			addComment() {
				axios.post(location.pathname + '/comments', {message: this.body})
					.then(response => {
						this.body = '';
						this.$emit('created', response.data);
					})
					.catch(function (error) {
						console.log(error);
					});
			}
		}
	}
</script>