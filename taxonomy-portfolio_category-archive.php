<?php
/*
Template Name: Portfolio Category Archive
*/

get_header();
?>

<div class="main-content container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Portfolio Categories</h1>

    <?php
    $categories = get_terms(array(
        'taxonomy'   => 'portfolio_category',
        'hide_empty' => false, // Show all categories even if they have no posts
    ));

    if (!empty($categories) && !is_wp_error($categories)) :
    ?>
        <div class="category-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($categories as $category) : 
                $image_id = get_term_meta($category->term_id, '_portfolio_category_image', true); // Corrected meta key
                $image_url = $image_id ? wp_get_attachment_url($image_id) : ''; // Get image URL
            ?>
                <a href="<?php echo esc_url(get_term_link($category)); ?>" class="block border p-4 shadow-md rounded-lg hover:shadow-lg transition">
                    <?php if ($image_url) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" class="w-full h-40 object-cover rounded-md mb-2">
                    <?php endif; ?>
                    <h2 class="text-xl font-semibold"><?php echo esc_html($category->name); ?></h2>
                    <p class="text-gray-600"><?php echo esc_html($category->description); ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="text-gray-600">No portfolio categories found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
