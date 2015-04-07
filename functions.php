<?php
// Custom functions go here

add_action( 'wp_enqueue_scripts', 'el_kampagne_enqueue_styles' );
function el_kampagne_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('zerif_bootstrap_style') );
  wp_enqueue_style( 'zerif-child-style', get_stylesheet_uri(), array('zerif_style'), 'v1' );
}

/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function el_kampagne_setup() {
    load_child_theme_textdomain( 'el-kampagne', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'el_kampagne_setup' );