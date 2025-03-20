<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8"><?php the_archive_title(); ?></h1>
    <p class="mb-6"><?php the_archive_description(); ?></p>

    <?php if ( is_post_type_archive('portfolio') ) : ?>
    <!-- AJAX Search Input -->
    <div id="portfolio-search" class="mb-8">
        <input type="text" id="ajax-search-input" placeholder="Search portfolio..." class="w-full p-2 border border-gray-300 rounded">
    </div>
<?php endif; ?>



<div id="ajax-search-results" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <?php include get_theme_file_path('components/portfolio-card.php'); ?>
        <!-- <?php get_template_part('components/portfolio-card'); ?> -->

        <?php endwhile; ?>
    <?php else : ?>
        <p class="text-gray-500">No posts found.</p>
    <?php endif; ?>
</div>


    <?php get_template_part('components/pagination'); ?>
</div>

<?php get_footer(); ?>
