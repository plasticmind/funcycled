<?php

/**
 * Custom Post Types
 */

/*
 * A function for creating our custom post types
 */

add_action( 'init', 'pm_create_custom_post_types' );

function pm_create_custom_post_types() {
    // Post type: Newsletter
    register_post_type(
    'newsletter',
    array(
        'labels'                => pm_post_type_labels( 'Newsletter' ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'exclude_from_search'   => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'query_var'             => true,
        'rewrite'               => array('with_front' => false, 'slug' => 'newsletter'),
        'capability_type'       => 'page',
        'can_export'            => true,
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-email-alt',
        'supports'              => array('title', 'editor', 'thumbnail', 'revisions', 'author', 'page-attributes')
    )
    );
}

/*
 * A helper function for generating labels
 */

function pm_post_type_labels( $singular, $plural = '' ) {
    if( $plural == '') $plural = $singular .'s';

    return array(
        'name' => _x( $plural, 'post type general name' ),
        'singular_name' => _x( $singular, 'post type singular name' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New '. $singular ),
        'all_items' => __( 'All '. $plural),
        'edit_item' => __( 'Edit '. $singular ),
        'update_item' => __( 'Update '. $singular ),
        'new_item' => __( 'New '. $singular ),
        'view_item' => __( 'View '. $singular ),
        'search_items' => __( 'Search '. $plural ),
        'not_found' =>  __( 'No '. $plural .' found' ),
        'not_found_in_trash' => __( 'No '. $plural .' found in Trash' ),
        'parent_item_colon' => ''
    );
}
