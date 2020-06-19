<!DOCTYPE html>
  <html lang="en-us" class="pf-m-redhat-font">
    <head>
      <meta charSet="utf-8"/>
      <meta http-equiv="x-ua-compatible" content="ie=edge"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <title>@yield('pageTitle')</title>
      <link rel="stylesheet" href="/assets/css/vendor-pf4.min.css" />

      <!-- Custom Styles -->
      <link rel="stylesheet" href="/assets/css/app.min.css" />
      <!-- JS -->
      <script type="text/javascript" src="/assets/js/app.min.js"></script>
      
    </head>
    <body>
    <div id="___gatsby">
      <div style="outline:none" tabindex="-1" id="gatsby-focus-wrapper">
        <main class="ws-site-root">
          <div class="ws-fullscreen-example">

            <div class="pf-c-backdrop">
              <div class="pf-l-bullseye">
                <div class="pf-c-about-modal-box" role="dialog" aria-modal="true" aria-labelledby="about-modal-title">
                  <div class="pf-c-about-modal-box__brand">
                    <a href="/"><img class="pf-c-about-modal-box__brand-image" src="/assets/css/assets/images/pf_mini_logo_white.svg" alt="PatternFly brand logo" /></a>
                  </div>
                  <div class="pf-c-about-modal-box__header">
                    <h1 class="pf-c-title pf-m-4xl" id="about-modal-title">@yield('modalTitle')</h1>
                  </div>
                  <div class="pf-c-about-modal-box__hero"></div>
                  <div class="pf-c-about-modal-box__content">
                    <div class="pf-c-content">
                      @yield('content')
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>