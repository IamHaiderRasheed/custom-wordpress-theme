<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo( 'name' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="p-4">
    <div class="container bg-black lg:bg-transparent mx-auto flex items-center justify-between gap-2 rounded-md h-16 px-4">
        <!-- Logo -->
        <div class="flex items-center bg-transparent rounded-md lg:bg-black h-full">
            <?php 
            if ( has_custom_logo() ) {
                the_custom_logo(); 
            } else { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-lg text-white font-bold">Yakuza</a>
            <?php } ?>
        </div>

        <!-- Desktop Menu -->
        <nav class="hidden lg:flex flex-1 space-x-8 items-center justify-start bg-black border text-white rounded-md h-full pl-4">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'flex space-x-4 h-full', 
                'container'      => false,
                'fallback_cb'    => false,
                'items_wrap'     => '%3$s',
                'link_before'    => '<span class="hover:bg-white hover:text-black p-2 rounded-md">', // Add hover style here
                'link_after'     => '</span>',
            ) );
            ?>
        </nav>

        <!-- Sign In and Download Buttons -->
        <div class="hidden lg:flex items-center gap-2 h-full">
            <a href="<?php echo esc_url( wp_login_url() ); ?>" class="bg-black border text-white rounded-md h-full flex items-center px-4">Sign In</a>
            <a href="/download" class="bg-blue-600 text-white rounded-md h-full flex items-center px-4">Download</a>
        </div>

        <!-- Mobile Hamburger Icon -->
        <div class="lg:hidden flex items-center">
            <button id="mobile-menu-toggle" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden hidden">
        <div class="p-4 container mx-auto flex flex-col gap-2">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'space-y-4',
                'container'      => false,
                'fallback_cb'    => false,
                'items_wrap'     => '%3$s',
                'link_before'    => '<span class="hover:bg-black hover:text-white p-2 rounded-md">', // Apply same hover style to mobile
                'link_after'     => '</span>',
            ) );
            ?>
            <a href="<?php echo esc_url( wp_login_url() ); ?>" class="block w-full text-white bg-black border border-white rounded-md mt-2 text-center py-2">Sign In</a>
            <a href="/download" class="block w-full bg-blue-600 text-white rounded-md mt-2 text-center py-2">Download</a>
        </div>
    </div>
</header>

