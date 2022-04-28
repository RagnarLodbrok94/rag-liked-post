<?php
/**
 * Top liked posts template
 *
 * @var \WP_Query $query
 */
?>

<div class="rag-top-liked-posts">
	<?php foreach ( $query->posts as $post ) : ?>
		<?php $post_id    = $post->ID;
		$count_post_likes = rag_lp_get_count_post_likes( $post_id ); ?>
		<div class="rag-top-liked-posts-item">
			<a class="rag-top-liked-posts-item-link"
			   href=<?php echo esc_url( get_permalink( $post_id ) ) ?>><?php echo esc_html( get_the_title( $post_id ) ) ?></a>
			<span
			  class="rag-top-liked-posts-item-likes post-like-count"><?php echo esc_html( $count_post_likes ) ?></span>
		</div>
	<?php endforeach; ?>
</div>