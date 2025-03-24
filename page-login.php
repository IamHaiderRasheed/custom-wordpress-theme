<?php
/* Template Name: Login */

// Redirect logged-in users away from login page
if (is_user_logged_in()) {
    wp_redirect(home_url('/profile'));
    exit;
}

if (isset($_POST['submit_login'])) {
    $creds = array(
        'user_login'    => $_POST['username'],
        'user_password' => $_POST['password'],
        'remember'      => true
    );

    $user = wp_signon($creds, false);

    if (!is_wp_error($user)) {
        wp_redirect('/profile');
        exit;
    } else {
        $error_message = 'Invalid login credentials.';
    }
}

get_header(); // ✅ only call this AFTER the redirects
?>

<div class="max-w-xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-semibold mb-6 text-center">Login</h2>

    <form method="post" class="bg-white p-6 rounded-lg shadow-lg">
        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="username">Username or Email:</label>
            <input type="text" name="username" id="username" required
                   class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </p>

        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="password">Password:</label>
            <input type="password" name="password" id="password" required
                   class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </p>

        <p class="text-center">
            <button type="submit" name="submit_login"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                Login
            </button>
        </p>

        <?php if (!empty($error_message)) : ?>
            <p class="text-red-600 text-center mt-4"><?php echo esc_html($error_message); ?></p>
        <?php endif; ?>
    </form>
</div>

<?php get_footer(); ?>
