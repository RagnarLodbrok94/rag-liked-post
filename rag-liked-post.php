<?php
/**
 * Plugin Name: RagLikedPost
 * Plugin URI:  https://crocoblock.com/plugins/rag-liked-post/
 * Description: Adding likes to posts.
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: rag-liked-post
 * License:     GPL-2.0+
 */

// include script
function rag_liked_post_scripts() {
	wp_enqueue_script( 'my-custom-script', plugins_url( 'rag-liked-post.js', __FILE__ ), ['wp-blocks'], '', true );
	wp_localize_script( 'my-custom-script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'rag_liked_post_scripts' );

function rag_get_count_post_likes( $id, $type = 'rag_count_post_likes', $single = true ) {
	$current_count_likes = get_post_meta( $id, $type, $single );

	return ($current_count_likes ? $current_count_likes : 0);
}

// Adding a Like Button to Posts
add_action( 'the_post', function ( \WP_Post $post ) {
	$postID = $post->ID;
	$countPostLikes = rag_get_count_post_likes( $postID );

	ob_start();

	include 'templates/post-like.php';

	echo ob_get_clean();
}, 10, 1 );

function my_action_callback() {
	$postID = $_POST['id'];
	$countPostLikes = rag_get_count_post_likes( $postID );

	update_post_meta( $postID, 'rag_count_post_likes', ++$countPostLikes );

	$return = array(
		'countPostLikes' => $countPostLikes,
	);

	wp_send_json_success( $return );
}

if( wp_doing_ajax() ) {
	add_action( 'wp_ajax_my_action', 'my_action_callback' );
}


