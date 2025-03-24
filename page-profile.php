<?php
/* Template Name: Profile Page */

// 🔒 Redirect if not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

// 🔁 Handle logout
if (isset($_GET['logout'])) {
    wp_logout();
    wp_redirect(home_url('/login'));
    exit;
}

// 🧠 Get user info
$current_user = wp_get_current_user();

get_header(); // ✅ only call this AFTER all header logic
?>

<div class="max-w-xl mx-auto py-10 px-4 mb-8">
    <h2 class="text-3xl font-bold mb-4 text-center">Welcome, <?php echo esc_html($current_user->display_name); ?>!</h2>

    <div class="bg-white shadow-md p-6 rounded-lg text-center">
        <?php echo get_avatar($current_user->ID, 96, '', '', ['class' => 'rounded-full mx-auto mb-4']); ?>
        <p class="text-lg font-medium text-gray-700">Name: <?php echo esc_html($current_user->display_name); ?></p>
        <p class="text-lg text-gray-600">Email: <?php echo esc_html($current_user->user_email); ?></p>

        <a href="?logout=true" style="display:inline-block; margin-top:1.5rem; background-color:#dc2626; color:white; padding:0.5rem 1rem; border-radius:0.5rem; text-decoration:none; transition:background-color 0.3s;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#dc2626'">
    Logout
</a>

    </div>
</div>


<?php get_footer(); ?>
