<?php
get_header(); // Include the header template
?>

<div class="main-content container mx-auto p-4">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
        
            <div class="post-header flex flex-col sm:flex-row md:flex-row items-center justify-center space-x-4">
                <!-- Left side: Post Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(array(500, 500), ['class' => 'rounded']); // Use desired size ?>
                    </a>
                <?php endif; ?>
                
                <!-- Right side: Post Title and Author -->
                <div>
                    <h1 class="text-2xl font-bold"><?php the_title(); ?></h1>
                    
                    <!-- Category Badges -->
                    <div class="mt-2 mb-4">
                        <?php
                        // Fetch the categories
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            foreach ( $categories as $category ) {
                                // Create a permalink for each category
                                $category_link = esc_url( get_category_link( $category->term_id ) ); // Get the category link
                                echo '<a href="' . $category_link . '" class="inline-block bg-blue-100 text-blue-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded-full">' . esc_html( $category->name ) . '</a>';
                            }
                        }
                        ?>
                    </div>
                    
                    <div class="text-md text-gray-600 mt-3">
                        <span><?php the_author(); ?></span> | 
                        <span><?php the_time(get_option('date_format')); ?></span>
                    </div>
                </div>
            </div>

            <!-- Post Content -->
            <div class="post-content mt-4">
                <?php the_content(); // Display the post content ?>
            </div>
        
        <?php endwhile;
    else :
        echo '<p>No content found.</p>';
    endif;
    ?>
    
   


</div>


<?php
get_footer(); // Include the footer template
?>
