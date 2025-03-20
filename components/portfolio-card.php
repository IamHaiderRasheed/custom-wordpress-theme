<article class="bg-white shadow-lg rounded-lg overflow-hidden">
    <a href="<?php the_permalink(); ?>">
        <img class="w-full h-48 object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        <div class="p-4">
            <h2 class="text-xl font-semibold mb-2"><?php the_title(); ?></h2>
            <p class="text-gray-700"><?php the_excerpt(); ?></p>
        </div>
    </a>
</article>
