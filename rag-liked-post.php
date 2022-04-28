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

define( 'RAG_LP__FILE__', __FILE__ );
define( 'RAG_LP_PATH', plugin_dir_path( RAG_LP__FILE__ ) );

// Connecting script
function rag_lp_block_frontend_scripts() {
	wp_enqueue_style( 'rag-liked-post-frontend-style', plugins_url( 'assets/css/frontend.css', __FILE__ ) );
	wp_enqueue_script( 'rag-liked-post-frontend-script', plugins_url( 'rag-liked-post.js', __FILE__ ), [ 'wp-blocks' ], '', true );
	wp_localize_script( 'rag-liked-post-frontend-script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'rag_lp_block_frontend_scripts' );

function rag_lp_get_count_post_likes( $id, $type = 'rag_count_post_likes', $single = true ) {
	$current_count_likes = get_post_meta( $id, $type, $single );

	return ( $current_count_likes ? $current_count_likes : 0 );
}

// Adding a Like Button to Posts
add_action( 'the_post', function ( \WP_Post $post ) {
	if ( is_admin() || defined( 'REST_REQUEST' ) ) {
		return;
	}

	$user_id          = get_current_user_id();
	$post_id          = $post->ID;
	$count_post_likes = rag_lp_get_count_post_likes( $post_id );
	$key_user_meta    = 'rag_liked_posts';
	$liked_posts      = get_user_meta( $user_id, $key_user_meta, true );
	$btn_text         = 'Like';

	if ( '' !== $liked_posts ) {
		// мета-поле есть
		$arr = json_decode( $liked_posts, true );

		if ( is_array( $arr ) || is_object( $arr ) ) {
			foreach ( $arr as $key => $value ) {
				if ( + $key == $post_id ) {
					$btn_text       = 'Liked';
					$btn_like_state = 'post-liked-btn';
				}
			}
		}

	}

	ob_start();

	include 'templates/post-like.php';

	echo ob_get_clean();
}, 10, 1 );

function rag_lp_like_button_callback() {
	$user_id          = get_current_user_id();
	$post_id          = $_POST['id'];
	$key_user_meta    = 'rag_liked_posts';
	$key_post_meta    = 'rag_count_post_likes';
	$liked_posts      = get_user_meta( $user_id, $key_user_meta, true );
	$count_post_likes = rag_lp_get_count_post_likes( $post_id );

	if ( '' !== $liked_posts ) {
		// мета-поле есть
		$arr = json_decode( $liked_posts, true );

		if ( array_key_exists( $post_id, $arr ) ) {
			unset( $arr[ $post_id ] );
			-- $count_post_likes;
			$btn_text = 'Like';
		} else {
			$arr[ $post_id ] = true;
			++ $count_post_likes;
			$btn_text = 'Liked';
		}

		if ( ! empty( $arr ) ) {
			$json_arr = json_encode( $arr );
			update_user_meta( $user_id, $key_user_meta, $json_arr );
		} else {
			delete_user_meta( $user_id, $key_user_meta );
		}

		if ( $count_post_likes > 0 ) {
			update_post_meta( $post_id, $key_post_meta, $count_post_likes );
		} else {
			delete_post_meta( $post_id, $key_post_meta );
		}

	} else {
		$json_arr = json_encode( array( $post_id => true ) );
		add_user_meta( $user_id, $key_user_meta, $json_arr );
		update_post_meta( $post_id, $key_post_meta, ++ $count_post_likes );
		$btn_text = 'Liked';
	}

	$return = array(
		'countPostLikes' => $count_post_likes,
		'btnText'        => $btn_text,
		'btnLikeState'   => 'post-liked-btn',
	);

	wp_send_json_success( $return );
}

if ( wp_doing_ajax() ) {
	add_action( 'wp_ajax_like_button_action', 'rag_lp_like_button_callback' );
}

function rag_lp_block_editor_scripts() {
	wp_enqueue_script( 'rag-liked-post-blocks', plugins_url( 'assets/js/build/block.js', __FILE__ ), [ 'wp-blocks' ], '', true );
}

add_action( 'enqueue_block_editor_assets', 'rag_lp_block_editor_scripts' );

require_once( 'includes/blocks.php' );