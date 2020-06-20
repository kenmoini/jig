</section>
<div id="page-footer" class="container pf-u-p-xl">
  <p>
    <em>Crafted by Polyglot Ventures</em>
  </p>
</div>

<!-- SlimScroll -->
<script type="text/javascript" src="/assets/js/vendor-slimscroll.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function() {

  //This works for the single expanding nav - to do recursive would need to store the match and loop over each this.hasClass
  if (jQuery(".pf-c-nav__subnav ul li a.pf-c-nav__link").hasClass("pf-m-current")) {
    jQuery("#nav-admin-section").parent().addClass('pf-m-expanded');
    jQuery("#nav-admin-section").removeClass('collapse show').collapse('show');
  }

  jQuery('#nav-admin-section').on('hide.bs.collapse', function() {
    jQuery(this).parent().removeClass('pf-m-expanded');
  }).on('show.bs.collapse', function() {
    jQuery(this).parent().addClass('pf-m-expanded');
  });
});
</script>

@yield('footerScripts')

</body>

</html>