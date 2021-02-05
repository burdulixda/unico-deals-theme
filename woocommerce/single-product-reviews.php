<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews comment__container">
	<div class="comment__title--container">
		<h2 class="comment__title animate__animated animate__fadeInRight">
			<span class="comment__title--text comment__title--bold">რეკომენდირებულია</span>
			<span class="comment__title--text comment__title--regular">გამოკითხული მომხმარებელთა </span>
			<span class="comment__title--text comment__title--blue">99.9%</span>
			<span class="comment__title--text comment__title--regular">-ის მიერ</span>
		</h2>
	</div>
	<div id="comments" class="comments__container">

		<?php if ( have_comments() ) : ?>
			<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
		<?php endif; ?>
	</div>

	<div div class="w-100 d-flex justify-content-center" data-aos="flip-up" data-aos-duration="1000">
		<button class="comment__button" data-target="#unicoAddComment" data-toggle="modal">კომენტარის დამატება</button>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<aside class="modal fade p-0" id="unicoAddComment">
			<div class="unico__modalContainer modal-dialog h-100 modal-lg">
				<div class="modal-content border-1">
					<div class="modal-body unico-modal__radius p-sm-5">

						<div class="modal__search--container row justify-content-end">
							<div class="modal__close d-flex align-items-center">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
						</div>
						<div class="unico-comment__container">
							<?php
							$commenter    = wp_get_current_commenter();
							$comment_form = array(
								/* translators: %s is product title */
								'title_reply'         => '',
								/* translators: %s is product title */
								'title_reply_to'      => '',
								'comment_notes_after' => '',
								'label_submit'        => esc_html__( 'გაგზავნა', 'woocommerce' ),
								'class_submit'        => 'unico-button unico-button__blue',
								'id_submit'           => '',
								'logged_in_as'        => '',
								'comment_field'       => '',
							);

							$name_email_required = (bool) get_option( 'require_name_email', 1 );
							$fields              = array(
								'author' => array(
									'label'    => __( 'სახელი', 'woocommerce' ),
									'type'     => 'text',
									'value'    => $commenter['comment_author'],
									'required' => $name_email_required,
								),
								'email'  => array(
									'label'    => __( 'ელ. ფოსტა', 'woocommerce' ),
									'type'     => 'email',
									'value'    => $commenter['comment_author_email'],
									'required' => $name_email_required,
								),
							);

							$comment_form['fields'] = array();

							foreach ( $fields as $key => $field ) {
								$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
								$field_html .= '<label class="unico-comment__label" for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

								if ( $field['required'] ) {
									$field_html .= '&nbsp;<span class="required">*</span>';
								}

								$field_html .= '</label><input class="unico-comment__input" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

								$comment_form['fields'][ $key ] = $field_html;
							}

							$account_page_url = wc_get_page_permalink( 'myaccount' );
							if ( $account_page_url ) {
								/* translators: %s opening and closing link tags respectively */
								$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
							}

							$comment_form['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="კომენტარის შინაარსი" required></textarea></p>';

							if ( wc_review_ratings_enabled() ) {
								$comment_form['comment_field'].= '<div class="comment-form-rating d-flex justify-content-between align-items-center mb-3"><select name="rating" id="rating" required>
									<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
									<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
									<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
									<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
									<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
									<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
								</select><div class="upload-image__container" onclick="uploadImage()"><i class="uil uil-image-plus"></i><span>სურათის ატვირთვა</span></div></div>';
							}


							comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
							?>

						</div>

					</div>
				</div>
			</div>
		</aside>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
	<?php endif; ?>

	<div class="clear"></div>
</div>
