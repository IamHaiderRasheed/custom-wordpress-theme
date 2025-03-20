<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add image field to Portfolio Category add/edit form
function add_portfolio_category_image_field($term) {
    $image_id = '';

    // Check if $term is an object (edit mode), otherwise set $image_id as empty
    if (is_object($term)) {
        $image_id = get_term_meta($term->term_id, '_portfolio_category_image', true);
    }

    $image_url = $image_id ? wp_get_attachment_url($image_id) : '';
    ?>
    <div class="form-field term-group">
        <label for="portfolio_category_image">Category Image</label>
        <input type="hidden" id="portfolio_category_image" name="portfolio_category_image" value="<?php echo esc_attr($image_id); ?>" />
        <button class="button portfolio-category-upload"><?php echo $image_id ? 'Change Image' : 'Upload Image'; ?></button>
        <button class="button portfolio-category-remove" style="<?php echo $image_id ? '' : 'display:none;'; ?>">Remove</button>
        <br>
        <img id="portfolio_category_preview" src="<?php echo esc_url($image_url); ?>" style="max-width: 150px; margin-top: 10px; display: <?php echo $image_id ? 'block' : 'none'; ?>;">
    </div>
    <?php
}

add_action('portfolio_category_edit_form_fields', 'add_portfolio_category_image_field'); // For editing
add_action('portfolio_category_add_form_fields', 'add_portfolio_category_image_field'); // For adding


// Save the Image Meta Field
function save_portfolio_category_image_field($term_id) {
    if (isset($_POST['portfolio_category_image'])) {
        update_term_meta($term_id, '_portfolio_category_image', sanitize_text_field($_POST['portfolio_category_image']));
    }
}
add_action('edited_portfolio_category', 'save_portfolio_category_image_field');
add_action('created_portfolio_category', 'save_portfolio_category_image_field');

// Display Image in Admin Columns
function add_portfolio_category_columns($columns) {
    $columns['category_image'] = 'Image';
    return $columns;
}
add_filter('manage_edit-portfolio_category_columns', 'add_portfolio_category_columns');

function populate_portfolio_category_columns($content, $column_name, $term_id) {
    if ($column_name === 'category_image') {
        $image_id = get_term_meta($term_id, '_portfolio_category_image', true);
        if ($image_id) {
            $image_url = wp_get_attachment_url($image_id);
            $content = '<img src="' . esc_url($image_url) . '" style="width:50px; height:auto;">';
        } else {
            $content = '<em>No Image</em>';
        }
    }
    return $content;
}
add_filter('manage_portfolio_category_custom_column', 'populate_portfolio_category_columns', 10, 3);

function enqueue_portfolio_category_scripts($hook) {
    if ($hook !== 'edit-tags.php' && $hook !== 'term.php') {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script(
        'portfolio-category-script',
        get_template_directory_uri() . '/assets/portfolio-category.js',
        array('jquery'),
        null,
        true
    );
}
add_action('admin_enqueue_scripts', 'enqueue_portfolio_category_scripts');

