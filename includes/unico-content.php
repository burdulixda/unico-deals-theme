<?php

add_action('unico_landing_content_thumbnail', 'woocommerce_template_loop_product_thumbnail');
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

add_action('init', function() {
  remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
  add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
});

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
  function woocommerce_template_loop_product_thumbnail() {
    echo woocommerce_get_product_thumbnail();
  } 
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {   
  function woocommerce_get_product_thumbnail( $size = 'deals-carousel' ) {
    global $post, $woocommerce;
    $output = '<div class="img__container">';

    if ( has_post_thumbnail() ) {               
        $output .= get_the_post_thumbnail( $post->ID, $size );
    } else {
      $output .= wc_placeholder_img( $size );
      // Or alternatively setting yours width and height shop_catalog dimensions.
      // $output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
    }                       
    $output .= '</div>';
    return $output;
  }
}