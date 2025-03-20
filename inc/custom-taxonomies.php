<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register Portfolio Category Taxonomy
function custom_portfolio_taxonomy() {
    $args = array(
        'label'             => __('Portfolio Categories', 'textdomain'),
        'public'            => true,
        'hierarchical'      => true, // true = Categories, false = Tags
        'rewrite'           => array('slug' => 'portfolio-category'),
    );
    register_taxonomy('portfolio_category', 'portfolio', $args);
}
add_action('init', 'custom_portfolio_taxonomy');
