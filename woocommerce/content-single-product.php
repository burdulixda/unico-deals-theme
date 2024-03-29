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
<!-- GALLERY MODAL -->
<aside class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-center align-items-center position-relative">
          <button class="modal__close" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <div class="slider-modal">
						<div class="img__container">
							<img src="<?php echo $product_thumbnail ?>" alt="slider-img">
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
    </div>
  </div>
</aside>

<section class="row m-3">

	<div class="col-md-3 col-12 d-md-block d-none order-md-0 order-3 p-0">

		<div class="unico-special">
			<span class="absolute__circle"></span>
			<h2 class="unico-special__title">კვირის სპეციალური შემოთავაზება</h2>
			<div class="unico-special__circle">
				<span class="circle__count"></span>
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
	
		<div class="d-flex justify-content-between align-items-center">

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

		<div class="unico-form__container d-md-none d-block animate__animated animate__bounce p-3">
			<h2  class="unico-form__title">შეუკვეთე ახლავე</h2>
			<form class="unico-form" method="POST" action="/">
				<input type="text" name="fullname" class="unico-input input__name" placeholder="სახელი, გვარი" data-valid="false" />
				<input type="tel" name="phone" class="unico-input input__phone" placeholder="ნომერი" data-valid="false" />
				<input type="hidden" name="sku" value="<?php echo $product->get_sku() ?>" />
				<input type="hidden" name="product_id" value="<?php echo $product->get_id() ?>" />

				<div class="unico-form__body">
					<div class="unico-calculator w-50">
						<span class="calculate" data-count="-1" onclick="calculate(this)"><i class="uil uil-minus-square"></i></span>
						<input type="number" min="1" max="<?php echo $product->get_stock_quantity() ?>" value="1" name="quick_order_quantity" class="calculate__result" />
						<span class="calculate" data-count="1" onclick="calculate(this)"><i class="uil uil-plus-square"></i></span>
					</div>
					<a href="tel:577156611" class="unico-form__button d-flex justify-content-center align-items-center w-50"><i class="uil uil-phone mr-4"></i>577 15 66 11</a>
				</div>
				
				<button type="submit" class="unico-button__red mt-4 "><i class="uil uil-shopping-cart mr-3"></i>სწრაფი შეძენა</button>

				<div class="unico-form__propositions mt-5">
					<div class="unico-proposition__container">
						<i class="uil uil-shield"></i>
						<span class="unico-proposition__title">გარანტია თითოეულ პროდუქტზე</span>
					</div>
					<div class="unico-proposition__container">
						<i class="uil uil-truck"></i>
						<span class="unico-proposition__title">მიწოდების სერვისი მთელი საქართველოს მასშტაბით</span>
					</div>
					<div class="unico-proposition__container">
						<i class="uil uil-repeat"></i>
						<span class="unico-proposition__title">ნივთის დაბრუნების პოლიტიკა</span>
					</div>
					<div class="unico-proposition__container">
						<i class="uil uil-money-withdraw"></i>
						<span class="unico-proposition__title">თანხის გადახდა ნივთის მიღებისას</span>
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

		<div class="unico-form__container d-md-block d-none animate__animated animate__fadeInRight p-5">
			<h2 class="unico-form__title">შეუკვეთე ახლავე</h2>
			<form class="unico-form" method="POST" action="/">
				<input type="text" name="fullname" class="unico-input input__name" placeholder="სახელი, გვარი" data-valid="false" />
				<input type="tel" name="phone" class="unico-input input__phone" placeholder="ნომერი" data-valid="false" />
				<input type="hidden" name="sku" value="<?php echo $product->get_sku() ?>" />
				<input type="hidden" name="product_id" value="<?php echo $product->get_id() ?>" />

				<div class="unico-form__body">
					<div class="unico-calculator">
						<span class="calculate" data-count="-1" onclick="calculate(this)"><i class="uil uil-minus-square"></i></span>
						<input type="number" min="1" max="<?php echo $product->get_stock_quantity() ?>" value="1" name="quick_order_quantity" class="calculate__result" />
						<span class="calculate" data-count="1" onclick="calculate(this)"><i class="uil uil-plus-square"></i></span>
					</div>
					<a href="tel:577156611" class="unico-form__button d-flex justify-content-center align-items-center"><i class="uil uil-phone mr-4"></i>577 15 66 11</a>
				</div>

				<button type="submit" class="unico-button__red mt-4"><i class="uil uil-shopping-cart mr-3"></i>სწრაფი შეძენა</button>
				

			</form>
		</div>

	</div>

	<div class="col-12 order-4 d-none d-md-flex">
		<div class="unico-form__propositions mt-5 d-md-flex justify-content-between align-items-center mb-5">
			<div class="unico-proposition__container">
				<i class="uil uil-shield"></i>
				<span class="unico-proposition__title">გარანტია თითოეულ პროდუქტზე</span>
			</div>
			<div class="unico-proposition__container">
				<i class="uil uil-truck"></i>
				<span class="unico-proposition__title">მიწოდების სერვისი მთელი საქართველოს მასშტაბით</span>
			</div>
			<div class="unico-proposition__container">
				<i class="uil uil-repeat"></i>
				<span class="unico-proposition__title">ნივთის დაბრუნების პოლიტიკა</span>
			</div>
			<div class="unico-proposition__container">
				<i class="uil uil-money-withdraw"></i>
				<span class="unico-proposition__title">თანხის გადახდა ნივთის მიღებისას</span>
			</div>
		</div>
	</div>

</section>

<div class="row mx-4" style="margin-bottom  : 20rem">

	<div class="col-md-6 col-12 p-0">
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
						<p class="unico-hurryup__text">დარჩენილია მხოლოდ <span>1</span></p>
						<a href="#checkoutForm">
							<span class="unico-hurryup__text--subtext">ყიდვა</span>
						</a>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="col-md-6 col-12 p-0 pl-md-5 pl-0 mt-md-0 mt-5">
		<div class="unico-attributes__container">
			<h2 class="unico-description__title">მახასიათებლები</h2>
			<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
		</div>
	</div>

</div>

<section class="row d-flex justify-content-center m-3">
	<?php do_action('unico_deal_single_product_reviews'); ?>
</section>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<section class="container-fluid unico-gradient__purple p-0 my-5">
	<div class="products__container">
		<span class="products__title">მსგავსი <span class="products__title--bold">შეთავაზებები</span></span>
		<div class="slider-products__container">
			<div class="unico-slider__products">
				<?php do_action('unico_deal_related_products'); ?>
			</div>
		</div>
	</div>
</section>

<?php get_template_part('services', get_post_format()); ?>