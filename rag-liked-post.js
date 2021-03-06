jQuery( function($) {
	let postLikes = document.querySelectorAll('.post-like');

	if (postLikes.length) {
		postLikes.forEach(node => {
			let postLikeBtn = node.querySelector('.post-like-btn');
			let postLikeCount = node.querySelector('.post-like-count');
			let postID = postLikeBtn.hasAttribute('data-post-id') ? postLikeBtn.getAttribute('data-post-id') : null;

			let data = {
				action: 'like_button_action',
				id: postID,
			};

			postLikeBtn.addEventListener('click', () => {
				$.ajax({
					url:  MyAjax.ajaxurl,
					type: 'POST',
					data: data,
					success: function(result){
						$(postLikeCount).text(result.data.countPostLikes);
						$(postLikeBtn).text(result.data.btnText);
						$(postLikeBtn).toggleClass(result.data.btnLikeState);
					}
				})
			})
		})
	}
});

