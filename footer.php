<?php wp_footer(); ?>


<footer class="bg-gray-800 text-white container mx-auto p-4 rounded-md ">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- First Column: Site Logo and Description -->
        <div class="flex flex-col">
            <!-- Logo -->
            <?php if (has_custom_logo()) : ?>
                <div class="mb-4">
                    <?php the_custom_logo(); ?>
                </div>
            <?php endif; ?>
            <!-- Site Description -->
            <p class="text-lg">
                <?php bloginfo('description'); ?>
            </p>
        </div>

        <!-- Second Column: Quick Links -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_class' => 'text-md   space-y-2',
                'container' => false,
            ));
            ?>
        </div>

      <!-- Third Column: Latest Posts -->
<div>
    <h3 class="text-lg font-semibold mb-4 ">Latest Posts</h3>
    <ul class="text-sm space-y-2">
        <?php
        $latest_posts = new WP_Query(array('posts_per_page' => 3)); // Limit to 3 posts
        while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
            <li class="flex items-center space-x-3">
                <!-- Slightly Rounded Thumbnail Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium', ['class' => 'w-12 h-12 rounded-lg']); // Make image slightly round with 'rounded-lg' and increase size ?>
                    </a>
                <?php endif; ?>
                
                <!-- Post Title -->
                <a href="<?php the_permalink(); ?>" class="hover:text-gray-300"><?php the_title(); ?></a>
            </li>
        <?php endwhile;
        wp_reset_postdata(); ?>
    </ul>
</div>



    </div>
</footer>

</body>
</html>
