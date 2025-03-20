<?php
// Add custom columns
function add_portfolio_columns($columns) {
    $columns['client_name'] = 'Client Name';
    $columns['portfolio_category'] = 'Categories';
    $columns['visibility'] = 'Visibility';
    return $columns;
}
add_filter('manage_portfolio_posts_columns', 'add_portfolio_columns');

// Populate custom columns
function populate_portfolio_columns($column, $post_id) {
    if ($column === 'client_name') {
        $client_name = get_post_meta($post_id, '_client_name', true);
        echo !empty($client_name) ? esc_html($client_name) : '<em>No Client Name</em>';
    }

    if ($column === 'visibility') {
        $post_status = get_post_status($post_id);
        $post_password = get_post_field('post_password', $post_id);
        if (!empty($post_password)) {
            echo '<strong>Password Protected</strong>';
        } elseif ($post_status === 'private') {
            echo '<strong>Private</strong>';
        } else {
            echo '<strong>Public</strong>';
        }
    }

    if ($column === 'portfolio_category') {
        $terms = get_the_terms($post_id, 'portfolio_category');
        if (!empty($terms) && !is_wp_error($terms)) {
            $categories = wp_list_pluck($terms, 'name');
            echo esc_html(implode(', ', $categories));
        } else {
            echo '<em>No Categories</em>';
        }
    }
}
add_action('manage_portfolio_posts_custom_column', 'populate_portfolio_columns', 10, 2);
?>




<?php
// Make Client Name Column Sortable
function make_portfolio_columns_sortable($columns) {
    $columns['client_name'] = 'client_name';
    return $columns;
}
add_filter('manage_edit-portfolio_sortable_columns', 'make_portfolio_columns_sortable');

// Custom Sorting Logic
function sort_portfolio_by_client_name($query) {
    if (!is_admin()) return;

    $orderby = $query->get('orderby');
    if ($orderby == 'client_name') {
        $query->set('meta_key', '_client_name');
        $query->set('orderby', 'meta_value');
        $query->set('meta_type', 'CHAR');
    }
}
add_action('pre_get_posts', 'sort_portfolio_by_client_name');
?>
