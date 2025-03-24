<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Register AJAX handler for logged-in and guest users
add_action('wp_ajax_submit_portfolio_form', 'handle_portfolio_form_submission');
add_action('wp_ajax_nopriv_submit_portfolio_form', 'handle_portfolio_form_submission');

function handle_portfolio_form_submission() {
    check_ajax_referer('portfolio_form_nonce');

    $title = sanitize_text_field($_POST['title']);
    $content = sanitize_textarea_field($_POST['content']);
    $client_name = sanitize_text_field($_POST['client_name']);

    $post_id = wp_insert_post(array(
        'post_type'   => 'portfolio',
        'post_title'  => $title,
        'post_content'=> $content,
        'post_status' => 'publish'
    ));

    $category_id = intval($_POST['portfolio_category']);

if ($category_id && $post_id && !is_wp_error($post_id)) {
    wp_set_post_terms($post_id, array($category_id), 'portfolio_category');
}


    if (is_wp_error($post_id)) {
        wp_send_json_error(['message' => 'Error creating post.']);
    }

    update_post_meta($post_id, '_client_name', $client_name);

    // Handle featured image
    if (!empty($_FILES['featured_image']['name'])) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $upload = wp_handle_upload($_FILES['featured_image'], ['test_form' => false]);

        if (!isset($upload['error'])) {
            $attachment = array(
                'post_mime_type' => $upload['type'],
                'post_title'     => sanitize_file_name($upload['file']),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );

            $attachment_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
            $attach_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
            wp_update_attachment_metadata($attachment_id, $attach_data);
            set_post_thumbnail($post_id, $attachment_id);
        }
    }

    wp_send_json_success(['message' => 'Portfolio submitted successfully!']);
}

// Enqueue JS for frontend form
add_action('wp_enqueue_scripts', 'enqueue_portfolio_form_script');
function enqueue_portfolio_form_script() {
    wp_enqueue_script(
        'portfolio-form-js',
        get_template_directory_uri() . '/assets/portfolio-form.js',
        array(),
        null,
        true
    );

    wp_localize_script('portfolio-form-js', 'portfolio_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('portfolio_form_nonce')
    ));
}
