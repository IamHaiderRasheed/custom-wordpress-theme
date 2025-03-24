<?php
/* Template Name: Submit Portfolio */
get_header();

// Fetch taxonomy terms for the dropdown
$terms = get_terms(array(
    'taxonomy' => 'portfolio_category',
    'hide_empty' => false,
));
?>

<div class="max-w-xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-semibold mb-6 text-center">Submit a Portfolio Item</h2>

    <form id="portfolio-form" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="title">Title:</label>
            <input type="text" name="title" id="title" required
                   class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </p>

        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="content">Description:</label>
            <textarea name="content" id="content" rows="5" required
                      class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300"></textarea>
        </p>

        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="client_name">Client Name:</label>
            <input type="text" name="client_name" id="client_name" required
                   class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </p>

        <!-- Custom Taxonomy Dropdown -->
        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="portfolio_category">Category:</label>
            <select name="portfolio_category" id="portfolio_category"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
                <option value="">-- Select a Category --</option>
                <?php foreach ($terms as $term): ?>
                    <option value="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p class="mb-4">
            <label class="block text-gray-700 font-medium" for="featured_image">Featured Image:</label>
            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                   class="w-full border border-gray-300 p-2 rounded-lg focus:ring focus:ring-blue-300">
        </p>

        <p class="text-center">
            <button type="submit"
                    class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300 cursor-pointer">
                Submit Portfolio
            </button>
        </p>

        <p id="response-message" class="text-center mt-2 text-green-500 "></p>
    </form>
</div>

<?php get_footer(); ?>
