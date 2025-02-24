<?php
function sv_theme_scripts() {
    wp_enqueue_style( 'output', get_template_directory_uri() . '/dist/output.css', array() );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array() );

    wp_enqueue_script('mobile-menu', get_template_directory_uri() . '/assets/mobile-menu.js', array(), null, true);
    
    wp_register_script(
        'gallery-script',
        get_template_directory_uri() . '/assets/portfolioGallery.js',
        array(),
        null,
        true
    );
    wp_enqueue_script('gallery-script');
    
}
add_action( 'wp_enqueue_scripts', 'sv_theme_scripts' );

function custom_theme_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    ));

    add_theme_support('post-thumbnails');

    // Register menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'textdomain' ),
        'footer-menu' => __( 'Footer Menu', 'textdomain' ),
    ));
}
add_action( 'after_setup_theme', 'custom_theme_setup' );

// Register Footer Widget Area
function footer_widget_init() {
    register_sidebar(array(
        'name'          => __('Recent Posts', 'textdomain'), // Consistent text domain
        'id'            => 'recentposts',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-lg font-semibold mb-4">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'footer_widget_init');

add_filter( 'nav_menu_css_class', 'add_portfolio_current_class', 10, 2 );
function add_portfolio_current_class( $classes, $item ) {
    // Check if it's a portfolio archive page or a single portfolio item
    if ( ( is_post_type_archive( 'portfolio' ) || is_singular( 'portfolio' ) ) && $item->url === get_post_type_archive_link( 'portfolio' ) ) {
        $classes[] = 'current-menu-item';
    }
    return $classes;
}

require_once get_template_directory() . '/inc/portfolio-cpt.php';
require_once get_template_directory() . '/inc/meta-boxes.php';

?>
