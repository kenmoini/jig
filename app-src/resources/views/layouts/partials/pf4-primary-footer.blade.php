</section>
<div id="page-footer" class="container pf-u-p-xl">
  <p>
    <em>Crafted by <a href="https://kenmoini.com">Ken Moini</a></em>
  </p>
</div>

<div class="pf-c-backdrop pf-u-display-none" id="loadingScreen">
  <div class="pf-l-bullseye">
    <span class="pf-c-spinner" role="progressbar" aria-valuetext="Loading...">
      <span class="pf-c-spinner__clipper"></span>
      <span class="pf-c-spinner__lead-ball"></span>
      <span class="pf-c-spinner__tail-ball"></span>
    </span>
  </div>
</div>


<!-- SlimScroll -->
<script type="text/javascript" src="/assets/js/vendor-slimscroll.min.js"></script>

<script type="text/javascript">
  function showLoadingScreen() {
    jQuery("#loadingScreen").removeClass('pf-u-display-none');
  }
  function hideLoadingScreen() {
    setTimeout(function() {
      jQuery("#loadingScreen").addClass('pf-u-display-none')
    }, 250);
  }

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