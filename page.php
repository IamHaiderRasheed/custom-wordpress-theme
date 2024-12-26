<?php
get_header(); 
?>

<div class="main-content container mx-auto p-4">
    <?php
   
    if (have_posts()) : 
        while (have_posts()) : the_post(); ?>
            <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile;
    else : ?>
        <p><?php esc_html_e('Sorry, the page you are looking for cannot be found.'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>