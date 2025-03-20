<?php
// custome form widget with form data submission in wp databas
class Custom_Contact_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'custom_contact_widget',
            __('Custom Contact Form', 'textdomain'),
            ['description' => __('A simple contact form widget', 'textdomain')]
        );
    }

    // Display the widget in the frontend
    public function widget($args, $instance) {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        ?>

        <!-- AJAX Contact Form -->
        <form id="custom-contact-form" class="bg-white p-6 rounded-lg shadow-lg">
            <p class="mb-4">
                <label for="contact_name" class="block text-gray-700 font-medium">Name:</label>
                <input type="text" id="contact_name" name="contact_name" required
                       class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
            </p>
            <p class="mb-4">
                <label for="contact_email" class="block text-gray-700 font-medium">Email:</label>
                <input type="email" id="contact_email" name="contact_email" required
                       class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
            </p>
            <p class="mb-4">
                <label for="contact_message" class="block text-gray-700 font-medium">Message:</label>
                <textarea id="contact_message" name="contact_message" required
                          class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300"></textarea>
            </p>
            <p class="text-center">
                <input type="submit" value="Send"
                       class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300 cursor-pointer">
            </p>
            <p id="contact-form-response" class="text-center text-sm mt-2 text-green-600"></p>
        </form>

        <!-- jQuery AJAX Script -->
        <script>
        jQuery(document).ready(function($) {
            $('#custom-contact-form').submit(function(e) {
                e.preventDefault(); // Prevent form reload
                
                var formData = {
                    action: 'custom_contact_form',
                    contact_name: $('#contact_name').val(),
                    contact_email: $('#contact_email').val(),
                    contact_message: $('#contact_message').val(),
                };

                $.post('<?php echo admin_url('admin-ajax.php'); ?>', formData, function(response) {
                    $('#contact-form-response').html(response);
                    $('#custom-contact-form')[0].reset(); // Reset form after submission
                });
            });
        });
        </script>

        <?php
        echo $args['after_widget'];
    }

    // Widget settings form in the admin area
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Contact Us', 'textdomain');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    // Update widget settings
    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }
}

// Register the Widget
function register_custom_contact_widget() {
    register_widget('Custom_Contact_Widget');
}
add_action('widgets_init', 'register_custom_contact_widget');

// Create database table for storing submissions
function custom_contact_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form_submissions';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'custom_contact_create_table');

// AJAX Form Submission Handler (Saves to Database)
function custom_contact_form_handler() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form_submissions';

    if (isset($_POST['contact_name'], $_POST['contact_email'], $_POST['contact_message'])) {
        $name = sanitize_text_field($_POST['contact_name']);
        $email = sanitize_email($_POST['contact_email']);
        $message = sanitize_textarea_field($_POST['contact_message']);

        // Save to database
        $wpdb->insert(
            $table_name,
            [
                'name' => $name,
                'email' => $email,
                'message' => $message,
            ],
            ['%s', '%s', '%s']
        );

        echo '<p style="color:green;">Message saved successfully!</p>';
    } else {
        echo '<p style="color:red;">Invalid submission.</p>';
    }

    wp_die();
}
add_action('wp_ajax_custom_contact_form', 'custom_contact_form_handler');
add_action('wp_ajax_nopriv_custom_contact_form', 'custom_contact_form_handler');

// Add a menu item in the WordPress admin panel
function custom_contact_add_admin_page() {
    add_menu_page(
        'Contact Form Submissions', // Page title
        'Contact Submissions',      // Menu title
        'manage_options',           // Capability
        'custom_contact_submissions', // Menu slug
        'custom_contact_render_admin_page', // Callback function
        'dashicons-email',          // Icon
        25                          // Position in the menu
    );
}
add_action('admin_menu', 'custom_contact_add_admin_page');

// Display the submissions in the admin panel
function custom_contact_render_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form_submissions';

    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC");

    echo '<div class="wrap"><h1>Contact Form Submissions</h1>';
    
    if (!empty($submissions)) {
        echo '<table class="widefat fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($submissions as $submission) {
            echo "<tr>
                    <td>{$submission->name}</td>
                    <td>{$submission->email}</td>
                    <td>{$submission->message}</td>
                    <td>{$submission->submitted_at}</td>
                  </tr>";
        }

        echo '</tbody></table>';
    } else {
        echo '<p>No submissions found.</p>';
    }

    echo '</div>';
}
?>
