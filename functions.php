<?php

// Declare WooCommerce Support

function mytheme_add_woocommerce_support() {
  add_theme_support( 'woocommerce', array(
      'thumbnail_image_width' => 150,
      'single_image_width'    => 300,

      'product_grid'          => array(
          'default_rows'    => 3,
          'min_rows'        => 2,
          'max_rows'        => 8,
          'default_columns' => 4,
          'min_columns'     => 2,
          'max_columns'     => 5,
      ),
  ) );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// Disable Gutenberg
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// Disable Gutenberg styles
function remove_woo_blocks(){
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wc-block-style' );
}

add_action( 'wp_enqueue_scripts', 'remove_woo_blocks', 100 );

// Disable WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	// unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
  unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
  
	return $enqueue_styles;
}

// Includes

require_once( __DIR__ . '/includes/unico-single-product.php');
require_once( __DIR__ . '/includes/unico-content.php');

if ( !function_exists( 'bootstrap' ) ) {

  function bootstrap() {
    wp_enqueue_style( 'bootstrap_css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css' );
    wp_enqueue_style( 'animate_css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css' );
    wp_enqueue_style( 'toastr_css', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css' );
    wp_enqueue_script( 'bootstrap_js','https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ),'',true );
    wp_enqueue_script( 'toastr_js','https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js', array( 'jquery' ),'',true );
    // wp_enqueue_script( 'Popper.js','https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', array( 'jquery' ),'',true );
    // wp_enqueue_script( 'bootstrapJs','https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', array( 'jquery' ),'',true );
  }
  
  add_action( 'wp_enqueue_scripts', 'bootstrap' );

}

if ( !function_exists( 'deals_libraries' ) ) {

  function deals_libraries() {
    wp_enqueue_style( 'slick_css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
    wp_enqueue_script( 'slick_js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '', true );

    wp_enqueue_style( 'unicons-line', 'https://unicons.iconscout.com/release/v3.0.3/css/line.css' );
  }

  add_action( 'wp_enqueue_scripts', 'deals_libraries' );

}

if ( !function_exists( 'deals_vital' ) ) {

  function deals_vital() {
    $styleVersion = '1.0';
    wp_enqueue_style( 'stylesheet', get_template_directory_uri() . '/style.css', '', 1, 'all' );
    wp_enqueue_style( 'unico_deals_stylesheet', get_template_directory_uri() . '/public/assets/styles/main.css', '', $styleVersion, 'all' );

    wp_register_script( 'deals_script', get_template_directory_uri() . '/public/assets/scripts/main.js', array('jquery'), '', true );
    wp_enqueue_script( 'deals_script' );
    $translation_array = array( 'wpAdminUrl' => admin_url(), 'unicoUrl' => get_home_url() );
    wp_localize_script( 'deals_script', 'unico_global', $translation_array );
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

// CREATE ORDER
add_action('wp_ajax_nopriv_create_custom_order', 'create_custom_order');
add_action('wp_ajax_create_custom_order', 'create_custom_order');

function create_custom_order() {
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = explode( " ", $_POST['fullname'] );

    $address = array(
      'first_name' => $full_name[0],
      'last_name' => $full_name[1],
      'phone' => $_POST['phone'],
    );
    
    $order = wc_create_order();

    $order->set_address($address, 'billing');

    // LOOP CART PRODUCTS FOR CRYSTAL & CREDO
    foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
      /** @var WC_Product $product */
      $product = $cart_item['data'];
      $product_quantity = $cart_item['quantity'];
    
      $order->add_product($product, $product_quantity);
    }

    $order->calculate_totals();

    $order->update_status('pending-payment', 'მუშავდება', true);
    $order->save();

    WC()->cart->empty_cart();
  }
}

add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
  remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}