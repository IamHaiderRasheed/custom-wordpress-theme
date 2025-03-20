<?php
// Add Meta Box
function add_client_name_meta_box() {
    add_meta_box(
        'client_name_meta',
        'Client Name',
        'client_name_meta_callback',
        'portfolio',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_client_name_meta_box');

// Meta Box Callback
function client_name_meta_callback($post) {
    $client_name = get_post_meta($post->ID, '_client_name', true);
    wp_nonce_field('save_client_name_meta', 'client_name_meta_nonce');
    ?>
    <label for="client_name">Client Name:</label>
    <input type="text" id="client_name" name="client_name" value="<?php echo esc_attr($client_name); ?>" style="width:100%;" />
    <?php
}

// Save Meta Box Data
function save_client_name_meta($post_id) {
    if (!isset($_POST['client_name_meta_nonce']) || !wp_verify_nonce($_POST['client_name_meta_nonce'], 'save_client_name_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (wp_is_post_revision($post_id)) {
        return;
    }

    if (isset($_POST['post_type']) && $_POST['post_type'] === 'portfolio') {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['client_name'])) {
            update_post_meta($post_id, '_client_name', sanitize_text_field($_POST['client_name']));
        }
    }
}
add_action('save_post_portfolio', 'save_client_name_meta');
?>
