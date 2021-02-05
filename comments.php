<?php
$args = array(
  'status' => 'approve'
);

$comments_query = new WP_Comment_Query;
$comments = $comments_query->query( $args );
?>

<?php if ($comments) : ?>
  <?php foreach ($comments as $comment) : ?>
    <div class="comment__item" data-aos="fade-left" data-aos-duration="500" id="comment-<?php comment_ID() ?>">

      <div class="comment__avatar d-md-flex d-none">
        <img src="<?php echo get_avatar_url($comment) ?>" alt="avatar" />
      </div>
          <!-- ITEM BODY -->
      <div class="comment__body">
        <div class="d-md-none d-flex mb-5">
          <div class="comment__avatar--mobile">
            <img src="<?php echo get_avatar_url($comment) ?>" alt="avatar" />
          </div>

          <div class="avatar__info">
            <h4 class="avatar__name"><?php comment_author() ?></h4>
            <i class="avatar__date"><?php comment_date() ?></i>
          </div>
        </div>

        <div class="comment__body--about d-md-flex d-none">
          <div class="avatar__info">
            <h4 class="avatar__name"><?php comment_author() ?></h4>
            <i class="avatar__date"><?php comment_date() ?></i>
          </div>

          <div class="unico-info__rating">
            <div class="stars">
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
            </div>
          </div>

        </div>
        <div class="comment__body--text">
          <?php echo $comment->comment_content ?>
        </div>
        <div class="d-flex justify-content-between w-100">

          <div class="unico-info__rating d-md-none d-flex">
            <div class="stars">
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
            </div>
          </div>
        </div>
      </div>

    </div>
  <?php endforeach ?>
<?php else : ?>
  <p>კომენტარები არ მოიძებნა.</p>
<?php endif; ?>