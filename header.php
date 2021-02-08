<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <!-- STICKY COUNTDOWN -->
  <aside class="container-fluid unico-sticky unico-prioritet-hight">
    <div class="container unico-container unico-sale__container">
      <div class="d-flex flex-md-row flex-column justify-content-between w-100 m-0">
        <div class="col-md-7 col-12 sale__title--container p-0">
          <h1 class="sale__title">აქციის დასრულებამდე დარჩენილია</h1>
          <h3 class="sale__title--subtitle"></h3>
        </div>

        <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) { ?>
          <div class="countdown__expire d-none" id="unico__date">
            <?php the_field('deal_expire_date'); ?>
          </div>
        <?php } ?>

        <div class="countdown d-flex justify-md-content-end justify-content-center col-md-4 col-12 p-0">
          <div class="countdown__elements">
            <div class="countdown__element countdown__days"></div>
            <div class="countdown__dots">:</div>
            <div class="countdown__element countdown__hours"></div>
            <div class="countdown__dots">:</div>
            <div class="countdown__element countdown__minutes"></div>
            <div class="countdown__dots">:</div>
            <div class="countdown__element countdown__seconds"></div>
          </div>
        </div>

      </div>

    </div>
  </aside>
  <!-- HEADER -->
  <header class="container-fluid unico-header p-0">
    <div class="container unico-container unico-special__mobile d-md-none d-block">
      <h2 class="unico-special__mobile--title">კვირის სპეციალური შემოთავაზება</h2>
      <span class="unico-special__mobile--subtitle">მარაგში დარჩნილია მხოლოდ</span>
      <div class="unico-special__mobile--circle">
        <span id="depended_circle_count" class="circle__count"></span>
      </div>
    </div>
    <!-- <div class="container unico-container unico-navbar">
      <?php // if (function_exists('the_custom_logo')) the_custom_logo(); ?>
    </div> -->
  </header>