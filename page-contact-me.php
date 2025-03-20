<?php
get_header(); 
?>

<div class="main-content container mx-auto p-4">

    <h1 class="text-3xl font-bold text-center mb-6">Contact Me</h1>

    <div class="max-w-lg mx-auto">
        <?php 
        the_widget('Custom_Contact_Widget'); // Add the widget directly 
        ?>
    </div>

</div>

<?php get_footer(); ?>
