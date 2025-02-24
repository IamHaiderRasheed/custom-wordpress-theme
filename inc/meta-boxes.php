<?php
function add_client_name_meta_box() {
    add_meta_box(
        'client_name_meta',
        'Client Name',
        'client_name_meta_callback',
        'portfolio', // Ensure it applies only to the Portfolio CPT
        'side', // Meta box position (normal, side, advanced)
        'default'
    );
}
add_action('add_meta_boxes', 'add_client_name_meta_box');

function client_name_meta_callback($post) {
    $client_name = get_post_meta($post->ID, '_client_name', true);
    // Add nonce field for security
    wp_nonce_field('save_client_name_meta', 'client_name_meta_nonce');
    ?>
    <label for="client_name">Client Name:</label>
    <input type="text" id="client_name" name="client_name" value="<?php echo esc_attr($client_name); ?>" style="width:100%;" />
    <?php
}

function save_client_name_meta($post_id) {
    // Check if nonce exists and is valid
    if (!isset($_POST['client_name_meta_nonce']) || !wp_verify_nonce($_POST['client_name_meta_nonce'], 'save_client_name_meta')) {
        return;
    }

    // Prevent autosaves from interfering
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Ensure this is for the 'portfolio' CPT only
    if (isset($_POST['post_type']) && $_POST['post_type'] === 'portfolio') {
        // Check user capabilities
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save client name meta field
        if (isset($_POST['client_name'])) {
            update_post_meta($post_id, '_client_name', sanitize_text_field($_POST['client_name']));
        }
    }
}
add_action('save_post_portfolio', 'save_client_name_meta');






function add_portfolio_columns($columns) {
    $columns['client_name'] = 'Client Name'; 
    $columns['visibility'] = 'Visibility'; 
    $columns['portfolio_excerpt'] = 'Excerpt'; 
    
    return $columns;
}
add_filter('manage_portfolio_posts_columns', 'add_portfolio_columns');



function populate_portfolio_columns($column, $post_id) {
    if ($column === 'client_name') {
        $client_name = get_post_meta($post_id, '_client_name', true);
        echo !empty($client_name) ? esc_html($client_name) : '<em>No Client Name</em>';
    }
    // if ($column === 'portfolio_excerpt') {
    //     $excerpt = get_the_excerpt($post_id);
    //     echo !empty($excerpt) ? esc_html($excerpt) : '<em>No Excerpt</em>';
    // }

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
}
add_action('manage_portfolio_posts_custom_column', 'populate_portfolio_columns', 10, 2);


function make_portfolio_columns_sortable($columns) {
    $columns['client_name'] = 'client_name';
    return $columns;
}
add_filter('manage_edit-portfolio_sortable_columns', 'make_portfolio_columns_sortable');

function sort_portfolio_by_client_name($query) {
    if (!is_admin()) return;
    
    $orderby = $query->get('orderby');
    if ($orderby == 'client_name') {
        $query->set('meta_key', '_client_name');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'sort_portfolio_by_client_name');

?>


