<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8"><?php the_archive_title(); ?></h1>
    <p class="mb-6"><?php the_archive_description(); ?></p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <a href="<?php the_permalink(); ?>">
                        <img class="w-full h-48 object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2"><?php the_title(); ?></h2>
                            <p class="text-gray-700"><?php the_excerpt(); ?></p>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p class="text-gray-500">No posts found.</p>
        <?php endif; ?>
    </div>

    <?php get_template_part('components/pagination'); ?>
</div>

<?php get_footer(); ?>
