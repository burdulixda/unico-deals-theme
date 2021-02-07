<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
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