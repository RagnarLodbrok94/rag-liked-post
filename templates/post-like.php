<div class="post-like">
	<?php if ( is_user_logged_in() ): ?>
		<button class="post-like-btn<?php echo $btn_like_state ? ' ' . $btn_like_state : '' ?>" data-post-id=<?php echo $post_id ?>><?php echo $btn_text ?></button>
	<?php endif; ?>
	<span class="post-like-count"><?php echo $count_post_likes ?></span>
</div>