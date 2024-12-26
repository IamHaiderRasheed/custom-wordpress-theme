<div class="mt-8">
        <?php
        // Pagination
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('« Previous', 'textdomain'),
            'next_text' => __('Next »', 'textdomain'),
        ));
        ?>
    </div>