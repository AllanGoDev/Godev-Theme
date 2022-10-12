<div class="fl-page-footer">
  <div class="fl-page-footer-container <?php FLLayout::container_class(); ?>">
    <div class="fl-page-footer-row <?php FLLayout::row_class(); ?>">
      <?php FLTheme::footer_col1(); ?>
      <?php FLTheme::footer_col2(); ?>
    </div>
  </div>
</div><!-- .fl-page-footer -->
<script>
  jQuery(document).ready(function($) {
    if ($(window).width() <= 1023) {
      var containHeader = $('.fl-page-header-container');
      var fixaMenu = $('#cabecalho');
      var logoMenu = $('.fl-page-nav-toggle-icon.fl-page-nav-toggle-visible-medium-mobile.fl-page-nav-right .fl-page-header-row .fl-page-header-logo');
      var iconeMenu = $('.fl-page-nav-toggle-icon.fl-page-nav-toggle-visible-medium-mobile .fl-page-nav .navbar-toggle');
      $(window).scroll(function() {
        if ($(this).scrollTop() > 20) {
          fixaMenu.css({
            'position': 'fixed',
            'transition': 'all 0.2s ease'
          });
          iconeMenu.css({
            'top': 10,
            'transition': 'all 0.2s ease'
          });
          logoMenu.css({
            'padding-bottom': 12,
            'transition': 'all 0.2s ease'
          });
          containHeader.css({
            'padding-top': 10,
            'transition': 'all 0.2s ease'
          });
        } else {
          fixaMenu.css({
            'position': 'relative',
            'transition': 'all 0.2s ease'
          });
          iconeMenu.css({
            'top': 10,
            'transition': 'all 0.2s ease'
          });
          logoMenu.css({
            'padding-bottom': 12,
            'transition': 'all 0.2s ease'
          });
          containHeader.css({
            'padding-top': 10,
            'transition': 'all 0.2s ease'
          });
        }
      });
    }
  });
</script>