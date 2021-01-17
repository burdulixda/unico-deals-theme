<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_gallery_image_ids = $product->get_gallery_image_ids();
$product_thumbnail = wp_get_attachment_url($product->get_image_id());

/**
 * Hook: woocommerce_before_single_product.
 *
 * @unhooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<section class="row">

	<div class="col-md-3 col-12 d-md-block d-none order-md-0 order-3 p-0">

		<div class="unico-special" data-aos="fade-right" data-aos-delay="500">
			<span class="absolute__circle"></span>
			<h2 class="unico-special__title">კვირის სპეციალური შემოთავაზება</h2>
			<div class="unico-special__circle">
				<span class="circle__count"><?php echo $product->get_stock_quantity(); ?></span>
				<span class="circle__count--word">ცალი</span>
			</div>
			<span class="unico-special__title--subtitle">მარაგში დარჩენილია მხოლოდ</span>
		</div>

		<div class="slider-top__nav">
			<div class="img__container" data-img="0" onclick="changeTopSlider(this)">
				<img src="<?php echo $product_thumbnail ?>" alt="slider-img" class="slider__active">
			</div>
			<?php foreach ($product_gallery_image_ids as $key => $product_gallery_image_id) : ?>
				<?php $gallery_image_url = wp_get_attachment_url($product_gallery_image_id); ?>
				<div class="img__container" data-img="<?php echo $key + 1; ?>" onclick="changeTopSlider(this)">
					<img src="<?php echo $gallery_image_url ?>" alt="slider-img" />
				</div>
			<?php endforeach; ?>
		</div>

	</div>

	<div class="col-md-5 col-12 d-flex flex-column order-md-1 order-2 p-0">
	
		<div class="d-flex justify-content-between align-items-center" data-aos="zoom-in" data-aos-duration="2000">

			<div class="slider-top__for">
				<img src="<?php echo $product_thumbnail ?>" data-toggle="modal" data-target="#imgModal" alt="slider-img" class="slider__active" />
				<?php foreach ($product_gallery_image_ids as $key => $product_gallery_image_id) : ?>
					<?php $gallery_image_url = wp_get_attachment_url($product_gallery_image_id); ?>
					<img src="<?php echo $gallery_image_url ?>" data-toggle="modal" data-target="#imgModal" alt="slider-img" />
				<?php endforeach; ?>
			</div>

			<div class="slider-top__nav d-md-none d-block">
				<div class="img__container" data-img="0" onclick="changeTopSlider(this)">
					<img src="<?php echo $product_thumbnail ?>" alt="slider-img" class="slider__active" />
				</div>
				<?php foreach ($product_gallery_image_ids as $key => $product_gallery_image_id) : ?>
					<?php $gallery_image_url = wp_get_attachment_url($product_gallery_image_id); ?>
					<div class="img__container" data-img="<?php echo $key +1; ?>" onclick="changeTopSlider(this)">
						<img src="<?php echo $gallery_image_url ?>" alt="slider-img" />
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="unico-form__container d-md-none d-block animate__animated animate__bounce">
			<h2 class="unico-form__title">შეუკვეთე ახლავე</h2>
			<form class="unico-form" method="POST" action="/">
				<input type="text" name="fullname" class="unico-input" placeholder="სახელი, გვარი" required />
				<input type="text" name="phone" class="unico-input" placeholder="ნომერი" required />
				<input type="hidden" name="sku" value="<?php echo $product->get_sku() ?>" />
				<input type="hidden" name="product_id" value="<?php echo $product->get_id() ?>" />

				<div class="unico-form__body">
					<div class="unico-calculator">
						<span class="calculate" data-count="-1" onclick="calculate(this)"><i class="uil uil-minus-square"></i></span>
						<input type="number" min="1" max="<?php echo $product->get_stock_quantity() ?>" value="1" name="quick_order_quantity" class="calculate__result" />
						<span class="calculate" data-count="1" onclick="calculate(this)"><i class="uil uil-plus-square"></i></span>
					</div>
					<button type="submit" class="unico-form__button"><i class="uil uil-shopping-cart"></i>შეძენა</button>
				</div>

				<div class="unico-form__body mt-5">
					<div class="">
						<div class="unico-proposition__container">
							<i class="uil uil-check"></i>
							<span class="unico-proposition__title">2 წლიანი გარანტია</span>
						</div>
						<div class="unico-proposition__container">
							<i class="uil uil-check"></i>
							<span class="unico-proposition__title">2 წლიანი გარანტია</span>
						</div>
					</div>
					<div class="">
						<div class="unico-proposition__container">
							<i class="uil uil-check"></i>
							<span class="unico-proposition__title">2 წლიანი გარანტია</span>
						</div>
						<div class="unico-proposition__container">
							<i class="uil uil-check"></i>
							<span class="unico-proposition__title">2 წლიანი გარანტია</span>
						</div>
					</div>

				</div>

			</form>
		</div>

	</div>

	<div class="col-md-4 col-12 order-md-2 order-1 p-0">

		<div class="unico-info">
			<?php do_action('unico_deal_single_product_title'); ?>
			<div class="unico-info__attributes animate__animated animate__fadeInLeft">
				<div class="unico-info__price">
					<?php do_action('unico_deal_single_product_price'); ?>
				</div>
				<div class="unico-info__rating">
					<?php do_action('unico_deal_single_product_rating') ?>
				</div>
			</div>
		</div>

		<div class="unico-form__container d-md-block d-none animate__animated animate__fadeInRight">
			<h2 class="unico-form__title">შეუკვეთე ახლავე</h2>
			<form class="unico-form" method="POST" action="/">
				<input type="text" name="fullname" class="unico-input" placeholder="სახელი, გვარი" required />
				<input type="text" name="phone" class="unico-input" placeholder="ნომერი" required />
				<input type="hidden" name="sku" value="<?php echo $product->get_sku() ?>" />
				<input type="hidden" name="product_id" value="<?php echo $product->get_id() ?>" />

				<div class="unico-form__body">
					<div class="unico-calculator">
						<span class="calculate" data-count="-1" onclick="calculate(this)"><i class="uil uil-minus-square"></i></span>
						<input type="number" min="1" max="<?php echo $product->get_stock_quantity() ?>" value="1" name="quick_order_quantity" class="calculate__result" />
						<span class="calculate" data-count="1" onclick="calculate(this)"><i class="uil uil-plus-square"></i></span>
					</div>
					<button type="submit" class="unico-form__button"><i class="uil uil-shopping-cart"></i>შეძენა</button>
				</div>

				<div class="unico-form__body mt-5">
					<div class="">
						<div class="unico-proposition__container">
							<i class="uil uil-check"></i>
							<span class="unico-proposition__title">2 წლიანი გარანტია</span>
						</div>
						<div class="unico-proposition__container">
							<i class="uil uil-check"></i>
							<span class="unico-proposition__title">2 წლიანი გარანტია</span>
						</div>
					</div>
					<div class="">
						<div class="unico-proposition__container">
							<i class="uil uil-check"></i>
							<span class="unico-proposition__title">2 წლიანი გარანტია</span>
						</div>
						<div class="unico-proposition__container">
							<i class="uil uil-check"></i>
							<span class="unico-proposition__title">2 წლიანი გარანტია</span>
						</div>
					</div>

				</div>

			</form>
		</div>

	</div>

</section>

<section class="row">

	<div class="col-md-6 col-12 p-0" data-aos="flip-right" data-aos-duration="1000">
		<div class="unico-description__container">
			<h2 class="unico-description__title">პროდუქტის აღწერა</h2>
			<?php do_action('unico_deal_single_product_excerpt'); ?>
			<div class="unico-description__footer d-flex flex-md-row flex-column justify-content-between align-items-center position-relative">

				<div class="col-md-6 col-12 d-flex justify-content-center p-0">
					<div class="unico-slider__description--container">
						<span class="description__circle"></span>
						<div class="unico-slider__description">
							<div class="img__container">
								<img src="<?php echo $product_thumbnail ?>" alt="slider-img" />
							</div>
							<?php foreach ($product_gallery_image_ids as $key => $product_gallery_image_id) : ?>
								<?php $gallery_image_url = wp_get_attachment_url($product_gallery_image_id); ?>
								<div class="img__container">
									<img src="<?php echo $gallery_image_url ?>" alt="slider-img" />
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-12 p-0 d-md-block d-none">
					<div class="unico-hurryup">
						<h3 class="unico-hurryup__title">იჩქარე!</h3>
						<span class="unico-hurryup__text">დარჩენილია მხოლოდ <?php echo $product->get_stock_quantity(); ?></span>
						<span class="unico-hurryup__text--subtext">ყიდვა</span>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="col-md-6 col-12 p-0 pl-md-5 pl-0 mt-md-0 mt-5" data-aos="flip-left" data-aos-duration="1500" data-aos-delay="delay">
		<div class="unico-attributes__container">
			<h2 class="unico-description__title">მახასიათებლები</h2>
			<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
		</div>
	</div>

</section>

<section class="row d-flex justify-content-center">
	<?php do_action('unico_deal_single_product_reviews'); ?>
</section>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<section class="container-fluid unico-gradient__purple p-0">
	<div class="products__container">
		<span class="products__title" data-aos="fade-right" data-aos-duration="1000">მსგავსი <span class="products__title--bold">შეთავაზებები</span></span>
		<div class="slider-products__container" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">
			<div class="unico-slider__products">
				<?php do_action('unico_deal_related_products'); ?>
			</div>
		</div>
	</div>
</section>

<?php get_template_part('services', get_post_format()); ?>