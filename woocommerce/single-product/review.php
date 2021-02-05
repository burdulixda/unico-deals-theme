<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<li <?php comment_class('comment__item'); ?> id="li-comment-<?php comment_ID(); ?>" data-aos="fade-left" data-aos-duration="500">

	<div class="comment__avatar d-md-flex d-none">
		<?php
			/**
			 * The woocommerce_review_before hook
			 *
			 * @hooked woocommerce_review_display_gravatar - 10
			 */
			do_action( 'woocommerce_review_before', $comment );
		?>
	</div>

		<div class="comment__body">
			<div class="d-md-none d-flex mb-5">

				<div class="comment__avatar--mobile">
					<?php
						/**
						 * The woocommerce_review_before hook
						 *
						 * @hooked woocommerce_review_display_gravatar - 10
						 */
						do_action( 'woocommerce_review_before', $comment );
					?>
				</div>

				<div class="avatar__info">
					<?php
						/**
						 * The woocommerce_review_meta hook.
						 *
						 * @hooked woocommerce_review_display_meta - 10
						 */
						do_action( 'woocommerce_review_meta', $comment );

						do_action( 'woocommerce_review_before_comment_text', $comment );
					?>
				</div>

			</div>

			<div class="comment__body--about d-md-flex d-none">
				<div class="avatar__info">
					<?php
						/**
						 * The woocommerce_review_meta hook.
						 *
						 * @hooked woocommerce_review_display_meta - 10
						 */
						do_action( 'woocommerce_review_meta', $comment );

						do_action( 'woocommerce_review_before_comment_text', $comment );
					?>
				</div>

				<div class="unico-info__rating">
					<?php
						/**
						 * The woocommerce_review_before_comment_meta hook.
						 *
						 * @hooked woocommerce_review_display_rating - 10
						 */
						do_action( 'woocommerce_review_before_comment_meta', $comment );
					?>
				</div>
			</div>

			<div class="comment__body--text">
				<?php
					/**
					 * The woocommerce_review_comment_text hook
					 *
					 * @hooked woocommerce_review_display_comment_text - 10
					 */
					do_action( 'woocommerce_review_comment_text', $comment );

					do_action( 'woocommerce_review_after_comment_text', $comment );
				?>
			</div>

			<div class="d-flex justify-content-between w-100">

				<div class="unico-info__rating d-md-none d-flex">
					<?php
						/**
						 * The woocommerce_review_before_comment_meta hook.
						 *
						 * @hooked woocommerce_review_display_rating - 10
						 */
						do_action( 'woocommerce_review_before_comment_meta', $comment );
					?>
				</div>
			</div>

		</div>
