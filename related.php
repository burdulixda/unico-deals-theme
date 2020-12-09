<section class="container-fluid unico-gradient__purple p-0">
  <div class="products__container">
    <span class="products__title" data-aos="fade-right" data-aos-duration="1000">მსგავსი <span class="products__title--bold">შეთავაზებები</span></span>
    <div class="slider-products__container" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">
      <!-- SLIDER -->
      <div class="unico-slider__products">
        <?php
          $args = array(
            'post_type' => 'post'
          );

          $post_query = new WP_Query($args);

          if($post_query->have_posts() ) {
            while($post_query->have_posts() ) {
              $post_query->the_post();
              ?>
              <article class="product-article">
                <div class="img__container">
                  <img src="<?php the_post_thumbnail_url(); ?>" alt="slider-img" />
                </div>
                <a href="<?php the_permalink() ?>" class="product-article__title"><?php echo the_title(); ?></a>
              </article>
              <?php
              }
            }
          ?>
      </div>
    </div>
  </div>
</section>