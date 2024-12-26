<?php
$categories = get_categories();

function render_category_card($category)
{
    $category_image = get_field('cat_image', 'category_' . $category->term_id);
    $category_description = $category->description;
    $category_link = get_category_link($category->term_id); // Get the link to the category
    ?>

    <a href="<?php echo esc_url($category_link); ?>"
        class="category-card relative overflow-hidden border rounded-lg shadow-md">
        <?php if ($category_image): ?>
            <img src="<?php echo esc_url($category_image['url']); ?>" alt="<?php echo esc_attr($category->name); ?>"
                class="category-image h-full w-full object-cover" />
        <?php endif; ?>

        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <span class="text-lg font-bold text-white py-2 px-3 bg-black"><?php echo esc_html($category->name); ?></span>
        </div>

    </a>

    <?php
}
?>

<div
    class="category-grid container mx-auto p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 relative">
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $category): ?>
            <?php render_category_card($category); // Call the category card function ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-gray-600">No categories found.</p>
    <?php endif; ?>

</div>