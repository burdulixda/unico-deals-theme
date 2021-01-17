<?php

add_action('woocommerce_before_single_product', 'unico_deal_single_product_wrapper_start');
function unico_deal_single_product_wrapper_start() {
  echo '<main class="container unico-container mt-5 px-md-0 px-4">';
}

add_action('woocommerce_after_single_product', 'unico_deal_single_product_wrapper_end');
function unico_deal_single_product_wrapper_end() {
  echo '</main>';
}

add_action('unico_deal_single_product_title', 'woocommerce_template_single_title');
add_action('unico_deal_single_product_price', 'woocommerce_template_single_price');
add_action('unico_deal_single_product_rating', 'woocommerce_template_single_rating');
add_action('unico_deal_single_product_excerpt', 'woocommerce_template_single_excerpt');
add_action('unico_deal_single_product_reviews', 'comments_template');
add_action('unico_deal_related_products', 'woocommerce_output_related_products');
