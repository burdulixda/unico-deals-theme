<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! $product_attributes ) {
	return;
}
?>
<ul class="attributes__container">
	<?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
		<li class="attribute__item attribute__item--<?php echo esc_attr( $product_attribute_key ); ?>">
			<span class="attribute__key"><?php echo wp_kses_post( $product_attribute['label'] ); ?></span>
			<span class="attribute__value"><?php echo wp_kses_post( $product_attribute['value'] ); ?></span>
		</li>
	<?php endforeach; ?>
</ul>

<span class="attributes-toggle">ყველა მახასიათებლის ნახვა</span>