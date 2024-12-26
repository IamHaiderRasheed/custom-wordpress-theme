<?php get_header(); ?>

<main class="flex items-center justify-center min-h-screen">
    <div class="text-center p-6">
        <h2 class="text-2xl  font-bold text-gray-800">404</h2>
        <h2 class="text-2xl mt-4 text-gray-600">Oops! Page not found.</h2>
        <p class="mt-2 text-gray-500">It seems we can’t find the page you’re looking for.</p>

        <div class="mt-9">
            <a href="<?php echo home_url(); ?>" class="bg-blue-500 text-black px-4 py-2 hover:bg-blue-600">Go to
                Home</a>
            <a href="<?php echo home_url('/category'); ?>"
                class="ml-4 text-gray-800 px-4 py-2 hover:bg-gray-400">Browse Categories</a>
        </div>
    </div>
</main>

<?php get_footer(); ?>