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

function example_block_editor_scripts() {
	wp_enqueue_script( 'example', plugins_url( 'example.js', __FILE__ ), ['wp-blocks'], '', true );
}

add_action( 'enqueue_block_editor_assets', 'example_block_editor_scripts' );

/*function rag_liked_post() {
	echo "Hello world";
}*/

/*add_action( 'admin_init', 'rag_liked_post' );*/