<main class="container unico-container mt-5 px-md-0 px-4">
  <!-- INTRO -->
  <section class="row">
    <div class="col-md-3 col-12 d-md-block d-none order-md-0 order-3 p-0">

      <div class="unico-special" data-aos="fade-right" data-aos-delay="500">
        <span class="absolute__circle"></span>
        <h2 class="unico-special__title">კვირის სპეციალური შემოთავაზება</h2>
        <div class="unico-special__circle">
          <span class="circle__count"><?php the_field('quantity'); ?></span>
          <span class="circle__count--word">ცალი</span>
        </div>
        <span class="unico-special__title--subtitle">მარაგში დარჩენილია მხოლოდ</span>
      </div>

      <div class="slider-top__nav">
        <?php foreach ($galleries as $gallery) : ?>
          <?php foreach ($gallery as $key => $value) : ?>
            <div class="img__container" data-img="<?php echo $key ?>" onclick="changeTopSlider(this)">
              <?php if ($key == 0) : ?>
                <img src="<?php echo $value ?>" alt="slider-img" class="slider__active" />
              <?php else : ?>
                <img src="<?php echo $value ?>" alt="slider-img" />
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="col-md-5 col-12 d-flex flex-column order-md-1 order-2 p-0">
      <div class="d-flex justify-content-between align-items-center" data-aos="zoom-in" data-aos-duration="2000">
        <div class="slider-top__for">
          <?php foreach ($galleries as $gallery) : ?>
            <?php foreach ($gallery as $key => $value) : ?>
              <?php if ($key == 0) : ?>
                <img src="<?php echo $value ?>" data-toggle="modal" data-target="#imgModal" alt="slider-img" class="slider__active" />
              <?php else : ?>
                <img src="<?php echo $value ?>" data-toggle="modal" data-target="#imgModal" alt="slider-img" />
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </div>

        <div class="slider-top__nav d-md-none d-block">
          <?php foreach ($galleries as $gallery) : ?>
            <?php foreach ($gallery as $key => $value) : ?>
              <div class="img__container" data-img="<?php echo $key ?>" onclick="changeTopSlider(this)">
                <?php if ($key == 0) : ?>
                  <img src="<?php echo $value ?>" alt="slider-img" class="slider__active" />
                <?php else : ?>
                  <img src="<?php echo $value ?>" alt="slider-img" />
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="unico-form__container d-md-none d-block animate__animated animate__bounce">
        <h2 class="unico-form__title">შეუკვეთე ახლავე</h2>
        <form class="unico-form" method="POST" action="/">
          <input type="text" name="unico-name" class="unico-input" placeholder="სახელი, გვარი" required />
          <input type="text" name="unico-password" class="unico-input" placeholder="ნომერი" required />

          <div class="unico-form__body">
            <div class="unico-calculator">
              <span class="calculate" data-count="-1" onclick="calculate(this)"><i class="uil uil-minus-square"></i></span>
              <span class="calculate__result">1</span>
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
        <h1 class="unico-info__title" data-aos="fade-left" data-aos-duration="1000"><?php the_title(); ?></h1>
        <div class="unico-info__attributes animate__animated animate__fadeInLeft">
          <div class="unico-info__price">
            <span class="price price__sale"><?php the_field('price') ?> ₾</span>
            <span class="price price__old"><?php the_field('old-price') ?> ₾</span>
          </div>
          <div class="unico-info__rating">

            <div class="stars">
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
              <i class="uil uil-star"></i>
            </div>
            <p class="rate">34 შეფასება</p>

          </div>
        </div>
      </div>

      <div class="unico-form__container d-md-block d-none animate__animated animate__fadeInRight">
        <h2 class="unico-form__title">შეუკვეთე ახლავე</h2>
        <form class="unico-form" method="POST" action="/">
          <input type="text" name="unico-name" class="unico-input" placeholder="სახელი, გვარი" required />
          <input type="text" name="unico-password" class="unico-input" placeholder="ნომერი" required />

          <div class="unico-form__body">
            <div class="unico-calculator">
              <span class="calculate" data-count="-1" onclick="calculate(this)"><i class="uil uil-minus-square"></i></span>
              <span class="calculate__result">1</span>
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
  <!-- DESCRIPTION -->
  <section class="row px-md-0 px-4">
    <div class="col-md-6 col-12 p-0" data-aos="flip-right" data-aos-duration="1000">
      <div class="unico-description__container">
        <h2 class="unico-description__title">პროდუქტის აღწერა</h2>
        <?php the_excerpt(); ?>
        <div class="unico-description__footer d-flex flex-md-row flex-column justify-content-between align-items-center position-relative">

          <div class="col-md-6 col-12 d-flex justify-content-center p-0">
            <div class="unico-slider__description--container">
              <span class="description__circle"></span>
              <div class="unico-slider__description">
                <?php foreach ($galleries as $gallery) : ?>
                  <?php foreach ($gallery as $key => $value) : ?>
                    <div class="img__container">
                      <img src="<?php echo $value ?>" alt="slider-img" />
                    </div>
                  <?php endforeach; ?>
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

    <div class="col-md-6 col-12 p-0 pl-md-5 pl-0 mt-md-0 mt-5" data-aos="flip-left" data-aos-duration="1500" data-aos-delay="delay">
      <div class="unico-attributes__container">
        <h2 class="unico-description__title">მახასიათებლები</h2>
        <ul class="attributes__container">
          <?php the_content(); ?>
          <li class="attribute__item">
            <span class="attribute__key">ბრენდი:</span>
            <span class="attribute__value">SAMSUNG</span>
          </li>
          <li class="attribute__item">
            <span class="attribute__key">ბრენდი:</span>
            <span class="attribute__value">SAMSUNG</span>
          </li>
          <li class="attribute__item">
            <span class="attribute__key">ბრენდი:</span>
            <span class="attribute__value">SAMSUNG</span>
          </li>
          <li class="attribute__item">
            <span class="attribute__key">ბრენდი:</span>
            <span class="attribute__value">SAMSUNG</span>
          </li>
        </ul>
        <span class="attributes-toggle">ყველა მახასიათებლის ნახვა</span>
      </div>
    </div>
  </section>
  <!-- COMMENTS -->
  <section class="row d-flex justify-content-center">
    <div class="comment__container">
      <div class="comment__title--container">
        <h2 class="comment__title animate__animated animate__fadeInRight">
          <span class="comment__title--bold">რეკომენდირებულია</span>გამოკითხულ მომხმარებელთა<span class="comment__title--blue">99.9%</span>-ის მიერ
        </h2>
      </div>

      <div class="comments__container">
        <!-- COMMENT ITEM -->
        <?php if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif; ?>

      </div>
      <div class="w-100 d-flex justify-content-center" data-aos="flip-up" data-aos-duration="1000">
        <button class="comment__button">კომენტარი დამატება</button>
      </div>

    </div>
  </section>
</main>