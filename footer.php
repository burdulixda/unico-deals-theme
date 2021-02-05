<footer class="container-fluid p-0">
  <div class="container unico-container p-0 px-4">
    <div class="row d-flex flex-md-row flex-column justify-content-between align-items-center py-5 m-0">

        <?php if (has_nav_menu('footer')) {
          wp_nav_menu(array(
            'theme_location' => 'footer'
          ));
        } ?>

      <span class="footer__unico">designed with <span class="unico-text__red">♥</span> by unico.ge</span>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>