<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="/img/favicon.ico" />

  <title>@yield('pageTitle')</title>

  <!-- PatternFly Styles -->
  <!-- Note: No other CSS files are needed regardless of what other JS packages located in patternfly/components that you decide to pull in -->
  <link rel="stylesheet" href="/assets/css/vendor-pf4.min.css" />
  <link rel="stylesheet" href="/assets/css/vendor-combined.min.css" />

  <!-- Custom Styles -->
  <link rel="stylesheet" href="/assets/css/app.min.css" />
  <!-- JS -->
  <script type="text/javascript" src="/assets/js/app.min.js"></script>

  @yield('headerScripts')

</head>

<body class="@yield('bodyClass')">

  <body>
    <div id="___gatsby">
      <div style="outline:none" tabindex="-1" id="gatsby-focus-wrapper">
        <main class="ws-site-root">
          <div class="ws-fullscreen-example">
            <div class="pf-c-page" id="page-expandable-nav-example">
              <a class="pf-c-skip-to-content pf-c-button pf-m-primary" href="#main-content">Skip to content</a>

              @include('layouts.partials.pf4-primary-header-bar')

              @include('layouts.partials.pf4-primary-nav')

              <main class="pf-c-page__main" tabindex="-1" id="main-content-page-expandable-nav-example">

                <section class="pf-c-page__main-section pf-m-light">
                  <div class="pf-c-content">
                    <h1>@yield('pageTitle')</h1>
                  </div>
                </section>
                <section class="pf-c-page__main-section" id="main-page-content">