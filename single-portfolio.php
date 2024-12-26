<?php
// single-portfolio.php
get_header(); ?>

<div class="main-content container mx-auto p-4">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <div class="portfolio-item">
                <!-- Display Portfolio Title -->
                <h1 class="portfolio-title text-2xl text-center font-bold mb-4 mt-3"><?php the_title(); ?></h1> <!-- Bigger title -->

                <!-- Display Project Description -->
                <div class="portfolio-description text-lg mb-4">
                    <?php echo get_field('project_description'); ?>
                </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large', ['class' => 'rounded-lg mb-4 ']); // Use a larger size ?>
                    </a>

                    <!-- Post Content -->
                    <div class="post-content mt-4 text-base leading-relaxed">
                        <?php the_content(); // Display the post content ?>
                    </div>

                    
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No portfolio items found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
