<?php

add_action('unico_landing_content_thumbnail', 'woocommerce_template_loop_product_thumbnail');
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);