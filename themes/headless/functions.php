<?php

// Remove GUTENBERG
add_filter( 'gutenberg_can_edit_post_type', '__return_false' );
add_filter('use_block_editor_for_post_type', '__return_false', 100);

// Remove editor
if(!function_exists('remove_editor')){
    function remove_editor() {
        remove_post_type_support('page', 'editor');
        remove_post_type_support('post', 'editor');
    }
    add_action('admin_init', 'remove_editor');
}

// Remove editor
if(!function_exists('a_theme_setup')){
    function a_theme_setup() {
        add_theme_support('post-thumbnails');
    }
    add_action('after_setup_theme', 'a_theme_setup');
}

//Featured image to REST API

function post_featured_image_json( $data, $post, $context ) {
    $featured_image_id = $data->data['featured_media'];
    $featured_image_url = wp_get_attachment_image_src( $featured_image_id, 'original' );
    if( $featured_image_url ) {
      $data->data['featured_image_url'] = $featured_image_url[0];
    }
    return $data;
  }
add_filter( 'rest_prepare_post', 'post_featured_image_json', 10, 3 );