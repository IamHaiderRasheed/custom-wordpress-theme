<?php
/* Template Name: Signup */
get_header();
?>

<div class="max-w-xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-semibold mb-6 text-center">Create an Account</h2>

    <form method="post" class="bg-white p-6 rounded-lg shadow-lg">
        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="username">Username:</label>
            <input type="text" name="username" id="username" required
                   class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </p>

        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="email">Email:</label>
            <input type="email" name="email" id="email" required
                   class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </p>

        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="password">Password:</label>
            <input type="password" name="password" id="password" required
                   class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </p>

        <p class="text-center">
            <button type="submit" name="submit_signup"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                Sign Up
            </button>
        </p>

        <?php
        if (isset($_POST['submit_signup'])) {
            $username = sanitize_user($_POST['username']);
            $email = sanitize_email($_POST['email']);
            $password = $_POST['password'];

            $error = [];

            if (username_exists($username) || email_exists($email)) {
                $error[] = 'Username or email already exists.';
            } else {
                $user_id = wp_create_user($username, $password, $email);
                if (!is_wp_error($user_id)) {
                    echo '<p class="text-green-600 text-center mt-4">Account created! You can now <a href="/login" class="text-blue-600 underline">log in</a>.</p>';
                } else {
                    $error[] = $user_id->get_error_message();
                }
            }

            if (!empty($error)) {
                echo '<p class="text-red-600 text-center mt-4">' . implode('<br>', $error) . '</p>';
            }
        }
        ?>
    </form>
</div>

<?php get_footer(); ?>
