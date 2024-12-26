<?php
function create_portfolio_cpt() {
    $labels = array(
        'name'               => 'Portfolio',
        'singular_name'      => 'Portfolio Item',
        'menu_name'          => 'Portfolio',
        'name_admin_bar'     => 'Portfolio Item',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Portfolio Item',
        'new_item'           => 'New Portfolio Item',
        'edit_item'          => 'Edit Portfolio Item',
        'view_item'          => 'View Portfolio Item',
        'all_items'          => 'All Portfolio Items',
        'search_items'       => 'Search Portfolio Items',
        'parent_item_colon'  => 'Parent Portfolio Items:',
        'not_found'          => 'No portfolio items found.',
        'not_found_in_trash' => 'No portfolio items found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'create_portfolio_cpt' );
