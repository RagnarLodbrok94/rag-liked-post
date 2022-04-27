<?php

function register_block_types_render_callback( $block_attributes, $content ) {
	$args = array(
		'post_status'    => 'publish',
		'orderby'        => 'meta_value_num',
		'meta_key'       => 'rag_count_post_likes',
		'posts_per_page' => '5'
	);

	$query = new WP_Query( $args );

	if ( $query->found_posts === 0 ) {
		return 'No posts';
	}

	ob_start();

	include RAG_LIKED_POST_PATH . 'templates/top-liked-posts.php';

	$import_template = ob_get_clean();

	return $import_template;
}

function register_block_types() {
	register_block_type( RAG_LIKED_POST_PATH . 'assets/js/src/top-posts/block.json', array(
		'render_callback' => 'register_block_types_render_callback'
	) );
}

add_action( 'init', 'register_block_types' );

