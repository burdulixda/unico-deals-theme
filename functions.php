<?php

if ( !function_exists( 'bootstrap' ) ) {

  function bootstrap() {
    wp_enqueue_style( 'bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css' );
    wp_enqueue_script( 'bootstrap_js','https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ),'',true );
    // wp_enqueue_script( 'Popper.js','https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array( 'jquery' ),'',true );
    // wp_enqueue_script( 'bootstrapJs','https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', array( 'jquery' ),'',true );
  }
  
  add_action( 'wp_enqueue_scripts', 'bootstrap' );

}

if ( !function_exists( 'deals_libraries' ) ) {

  function deals_libraries() {
    wp_enqueue_style( 'aos_css', 'https://unpkg.com/aos@2.3.1/dist/aos.css' );
    wp_enqueue_script( 'aos_js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '', true );

    wp_enqueue_style( 'slick_css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
    wp_enqueue_script( 'slick_js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '', true );

    wp_enqueue_style( 'unicons-line', 'https://unicons.iconscout.com/release/v3.0.3/css/line.css' );
  }

  add_action( 'wp_enqueue_scripts', 'deals_libraries' );

}

if ( !function_exists( 'deals_vital' ) ) {

  function deals_vital() {
    wp_enqueue_style( 'stylesheet', get_template_directory_uri() . '/style.css', '', 1, 'all' );

    $rand = rand( 1, 99999999999 );
    wp_enqueue_style( 'unico_deals_stylesheet', get_template_directory_uri() . '/public/assets/styles/main.css', '', $rand, 'all' );

    wp_enqueue_script( 'deals_script', get_template_directory_uri() . '/public/assets/scripts/main.js', array('jquery'), '', true );
  }

  add_action( 'wp_enqueue_scripts', 'deals_vital' );

}

if ( !function_exists( 'deals_custom_logo_setup' ) ) {
  
  function deals_custom_logo_setup() {

    $defaults = array(
    'height'      => 165,
    'width'       => 53,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
    );

    add_theme_support( 'custom-logo', $defaults );

   }

  add_action( 'after_setup_theme', 'deals_custom_logo_setup' );

}

add_filter( 'the_content', 'strip_shortcode_gallery' );

function strip_shortcode_gallery( $content ) {
  preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

  if ( ! empty( $matches ) ) {
      foreach ( $matches as $shortcode ) {
          if ( 'gallery' === $shortcode[2] ) {
              $pos = strpos( $content, $shortcode[0] );
              if( false !== $pos ) {
                  return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
              }
          }
      }
  }

  return $content;
}

add_theme_support('post-thumbnails');
add_image_size('deals-carousel', 220, 220);

add_action( 'after_setup_theme', 'register_footer_menu' );
 
function register_footer_menu() {
  register_nav_menu( 'footer', __( 'Footer Menu', 'theme-text-domain' ) );
}