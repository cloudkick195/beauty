<?php
function cptui_register_my_cpts() {

/**
 * Post Type: Events.
 */

$labels = [
    "name" => __( "Events", "custom-post-type-ui" ),
    "singular_name" => __( "Event", "custom-post-type-ui" ),
];

$args = [
    "label" => __( "Events", "custom-post-type-ui" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "event", "with_front" => true ],
    "query_var" => true,
    "supports" => [ "title", "editor", "thumbnail" ],
    "taxonomies" => [ "location" ],
    "show_in_graphql" => false,
];

register_post_type( "event", $args );

/**
 * Post Type: Reviews.
 */

$labels = [
    "name" => __( "Reviews", "custom-post-type-ui" ),
    "singular_name" => __( "review", "custom-post-type-ui" ),
];

$args = [
    "label" => __( "Reviews", "custom-post-type-ui" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "review", "with_front" => true ],
    "query_var" => true,
    "supports" => [ "editor", "thumbnail", "comments", "author" ],
    "show_in_graphql" => false,
];

register_post_type( "review", $args );

/**
 * Post Type: Questions.
 */

$labels = [
    "name" => __( "Questions", "custom-post-type-ui" ),
    "singular_name" => __( "Question", "custom-post-type-ui" ),
];

$args = [
    "label" => __( "Questions", "custom-post-type-ui" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "question", "with_front" => true ],
    "query_var" => true,
    "supports" => [ "title", "editor", "thumbnail", "comments", "author" ],
    "show_in_graphql" => false,
];

register_post_type( "question", $args );

/**
 * Post Type: Beautys.
 */

$labels = [
    "name" => __( "Beautys", "custom-post-type-ui" ),
    "singular_name" => __( "Beauty", "custom-post-type-ui" ),
];

$args = [
    "label" => __( "Beautys", "custom-post-type-ui" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "beauty", "with_front" => true ],
    "query_var" => true,
    "supports" => [ "title", "editor", "thumbnail", "excerpt", "comments" ],
    "show_in_graphql" => false,
];

register_post_type( "beauty", $args );

/**
 * Post Type: Doctors.
 */

$labels = [
    "name" => __( "Doctors", "custom-post-type-ui" ),
    "singular_name" => __( "Doctor", "custom-post-type-ui" ),
];

$args = [
    "label" => __( "Doctors", "custom-post-type-ui" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "doctor", "with_front" => true ],
    "query_var" => true,
    "supports" => [ "title", "editor", "thumbnail", "excerpt" ],
    "show_in_graphql" => false,
];

register_post_type( "doctor", $args );

/**
 * Post Type: User Register Event.
 */

$labels = [
    "name" => __( "User Register Event", "custom-post-type-ui" ),
    "singular_name" => __( "User Register Event", "custom-post-type-ui" ),
];

$args = [
    "label" => __( "User Register Event", "custom-post-type-ui" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "user_register_event", "with_front" => true ],
    "query_var" => true,
    "supports" => [ "title", "author" ],
    "show_in_graphql" => false,
];

register_post_type( "user_register_event", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
