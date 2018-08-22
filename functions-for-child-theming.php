<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-theme-name-here'; // This is parent theme style

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'parent',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


/**
 * Enqueue scripts and styles.
 */
function parent_child_scripts() {
    wp_enqueue_style( 'parent-style', get_stylesheet_uri() );
    wp_enqueue_script( 'parent-bootstrap', get_template_directory_uri() . '/assets/dist/bootstrap.min.js', array( 'jquery' ), '0.0.1', true );
    wp_enqueue_script( 'parent-script', get_template_directory_uri() . '/assets/dist/scripts.min.js', array( 'jquery' ), '0.0.1', true );

    $local = array(
        'isProduction' => defined( 'ENV' ) && 'production' === ENV ? true : false,
    );

    wp_localize_script( 'parent-script', 'parentStrings', $local );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'parent_child_scripts' );
