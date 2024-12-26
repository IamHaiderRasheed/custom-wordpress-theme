<?php
get_header(); // Loads header.php
?>

<div class="main-content container mx-auto p-4">

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php 
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post(); 
    ?>
    
    <article class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <a href="<?php the_permalink(); ?>">
        <img class="rounded-t-lg w-full h-48 object-cover" src="<?php the_post_thumbnail_url(); ?>" alt="Image representing <?php the_title(); ?>" />
    </a>
    <div class="p-5">
        <div class="mb-2">
            <!-- Display the category -->
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
        <header>
            <a href="<?php the_permalink(); ?>">
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php the_title(); ?></h2>
            </a>
        </header>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php the_excerpt(); ?></p>
        <footer>
            <a href="<?php the_permalink(); ?>" class="inline-flex items-center px-3 py-2 mt-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Read more
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </footer>
    </div>
</article>


    <?php
        } // end while
    } // end if
    ?>
       
    </div>

    <?php get_template_part('components/pagination'); ?>
    
</div>

<?php
get_footer(); 
?>
