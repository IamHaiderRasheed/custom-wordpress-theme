<?php
// AJAX handler for live portfolio search
function portfolio_ajax_search() {
    $search = sanitize_text_field($_POST['search']);

    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
        's' => $search,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            include get_theme_file_path('components/portfolio-card.php');
        endwhile;
    else :
        echo '<p class="text-gray-500">No results found.</p>';
    endif;

    wp_die();
}
add_action('wp_ajax_portfolio_ajax_search', 'portfolio_ajax_search');
add_action('wp_ajax_nopriv_portfolio_ajax_search', 'portfolio_ajax_search');


// Enqueue portfolio AJAX script
function yakuzabhai_enqueue_portfolio_scripts() {
    if (is_post_type_archive('portfolio')) {
        wp_enqueue_script(
            'portfolio-ajax-search',
            get_template_directory_uri() . '/assets/portfolioAjaxSearch.js',
            array(), // Add 'jquery' here if needed
            null,
            true
        );

        wp_localize_script('portfolio-ajax-search', 'portfolioSearch', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'yakuzabhai_enqueue_portfolio_scripts');
