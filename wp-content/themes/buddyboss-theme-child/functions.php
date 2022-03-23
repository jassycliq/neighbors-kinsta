<?php
/**
 * @package BuddyBoss Child
 * The parent theme functions are located at /buddyboss-theme/inc/theme/functions.php
 * Add your own functions at the bottom of this file.
 */


/****************************** THEME SETUP ******************************/

/**
 * Sets up theme for translation
 *
 * @since BuddyBoss Child 1.0.0
 */
function buddyboss_theme_child_languages()
{
  /**
   * Makes child theme available for translation.
   * Translations can be added into the /languages/ directory.
   */

  // Translate text from the PARENT theme.
  load_theme_textdomain( 'buddyboss-theme', get_stylesheet_directory() . '/languages' );

  // Translate text from the CHILD theme only.
  // Change 'buddyboss-theme' instances in all child theme files to 'buddyboss-theme-child'.
  // load_theme_textdomain( 'buddyboss-theme-child', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'buddyboss_theme_child_languages' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */
function buddyboss_theme_child_scripts_styles()
{
  /**
   * Scripts and Styles loaded by the parent theme can be unloaded if needed
   * using wp_deregister_script or wp_deregister_style.
   *
   * See the WordPress Codex for more information about those functions:
   * http://codex.wordpress.org/Function_Reference/wp_deregister_script
   * http://codex.wordpress.org/Function_Reference/wp_deregister_style
   **/

  // Styles
  wp_enqueue_style( 'buddyboss-child-css', get_stylesheet_directory_uri().'/assets/css/custom.css', '', '1.0.0' );

  // Javascript
  wp_enqueue_script( 'buddyboss-child-js', get_stylesheet_directory_uri().'/assets/js/custom.js', '', '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'buddyboss_theme_child_scripts_styles', 9999 );


/****************************** CUSTOM FUNCTIONS ******************************/

// Add your own custom functions here
add_theme_support('align-wide');

$transparent_header_timestamp = md5_file( get_stylesheet_directory().'/assets/js/transparent_header.js' );
define( 'TRANSPARENT_HEADER_VERSION', $transparent_header_timestamp );

$cover_image_overlay_timestamp = md5_file( get_stylesheet_directory().'/assets/js/cover_image_overlay.js' );
define( 'COVER_IMAGE_OVERLAY_VERSION', $cover_image_overlay_timestamp );

function transparent_header_script() {
    wp_enqueue_script( 'transparent_header-js', get_stylesheet_directory_uri() . '/assets/js/transparent_header.js', array( 'jquery' ), TRANSPARENT_HEADER_VERSION, true );
}

function cover_image_overlay_script() {
  wp_enqueue_script( 'cover_image_overlay-js', get_stylesheet_directory_uri() . '/assets/js/cover_image_overlay.js', array( 'jquery'), COVER_IMAGE_OVERLAY_VERSION, true);

}

add_action( 'wp_enqueue_scripts', 'transparent_header_script' );
add_action( 'wp_enqueue_scripts', 'cover_image_overlay_script');
?>