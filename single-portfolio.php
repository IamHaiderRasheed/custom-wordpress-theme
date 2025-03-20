<?php
// single-portfolio.php
get_header(); ?>

<div class="main-content container mx-auto p-4">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <div class="portfolio-item "> <!-- Center align text -->

                <!-- Display Portfolio Title -->
                <h1 class="portfolio-title text-3xl font-bold mb-4 mt-3 text-center"><?php the_title(); ?></h1> 

                <!-- Display Categories -->
                <div class="portfolio-categories flex justify-center gap-2 mb-4">
                    <?php 
                    $terms = get_the_terms(get_the_ID(), 'portfolio_category'); 
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<span class="bg-gray-800 text-white px-3 py-1 rounded-lg text-sm">' . esc_html($term->name) . '</span>';
                        }
                    }
                    ?>
                </div>

                <!-- Display Project Description -->
                <div class="portfolio-description text-lg mb-4">
                    <?php echo get_field('project_description'); ?>
                </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large', ['class' => 'rounded-lg mb-4 mx-auto block']); ?>
                    </a>
                <?php endif; ?>

                <!-- Post Content -->
                <div class="post-content mt-4 text-base leading-relaxed text-left">
                    <?php the_content(); ?>
                </div>

            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center">No portfolio items found.</p>
    <?php endif; ?>


    <?php if (is_active_sidebar('single-portfolio-post-widget')) : ?>
    <div class="single-post-sidebar bg-gray-100 p-6 rounded-lg shadow-md mt-12" style="margin-top: 40px;">
        <?php dynamic_sidebar('single-portfolio-post-widget'); ?>
    </div>
<?php endif; ?>


</div>

<?php get_footer(); ?>
