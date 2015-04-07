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

/**
 * Customizing Customizer
 *
 * Add extra fields to theme customizer.
 */
function el_kampagne_customizer( $wp_customize ) {
  $wp_customize->add_setting( 'el_kampagne_socials_website', array('sanitize_callback' => 'esc_url_raw','default' => '#'));
  
  $wp_customize->add_control(
    'el_kampagne_socials_website',
    array(
      'label' => __( 'Website link', 'el-kampagne' ),
      'section' => 'zerif_general_section',
      'settings' => 'el_kampagne_socials_website',
      'priority' => 8,
      'type' => 'text'
    )
  );

}
add_action( 'customize_register', 'el_kampagne_customizer' );
