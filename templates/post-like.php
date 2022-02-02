<div class="post-like">
	<?php if ( is_user_logged_in() ): ?>
		<button class="post-like-btn" data-post-id=<?php echo $postID ?>>Like</button>
	<?php endif; ?>
	<span class="post-like-count"><?php echo $countPostLikes ?></span>
</div>