<?php get_header(); echo "haider" ?>

<div class="main-content container mx-auto p-4">

    <!-- Show the Category Title & Description -->
    <h1 class="text-3xl font-bold">
        <?php single_term_title(); ?>
    </h1>
    <p class="text-gray-600">
        <?php echo term_description(); ?>
    </p>

    <!-- Include the Category Carousel -->


    <!-- Portfolio Items Loop -->
    <div class="grid grid-cols-3 gap-4 mt-6">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="border rounded-lg p-4 shadow">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="w-full h-48 object-cover">
                        <?php endif; ?>
                        <h2 class="text-xl font-semibold mt-2"><?php the_title(); ?></h2>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p class="text-gray-500">No portfolio items found in this category.</p>
        <?php endif; ?>
    </div>

</div>

<?php get_footer(); ?>
