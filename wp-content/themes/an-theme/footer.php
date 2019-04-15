    </section>

    <footer id="footer" class="w-full p-6 border-t-2 border-grey-light">
      <div id="copyright" class="text-center text-grey">
        &copy; <?php echo esc_html( date_i18n( __( 'Y', 'blankslate' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
      </div>
    </footer>
  </div>
  <?php wp_footer(); ?>
  </div>

  <script src="<?php echo get_template_directory_uri() ?>/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/js/an.js"></script>
</body>

</html>