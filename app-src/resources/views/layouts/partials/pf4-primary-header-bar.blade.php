<header class="pf-c-page__header">
  <div class="pf-c-page__header-brand">
    <div class="pf-c-page__header-brand-toggle">
      <button class="pf-c-button pf-m-plain" type="button" id="page-expandable-nav-example-nav-toggle"
        aria-expanded="true" data-toggle="collapse" data-target="#mainSideNav" aria-controls="mainSideNav"
        aria-label="Toggle navigation">
        <i class="fas fa-bars" aria-hidden="true"></i>
      </button>
    </div>
    <a href="/" class="pf-c-page__header-brand-link">
      <img class="pf-c-brand pf-u-mr-xl" src="{{"/assets/css/assets/images/pf_mini_logo_white.svg"}}" alt="PF logo" /> Jig
    </a>
  </div>
  <div class="pf-c-page__header-tools">
    <div class="pf-c-page__header-tools-group">
      <!--
      <div class="pf-c-page__header-tools-item pf-m-hidden pf-m-visible-on-lg">
        <button class="pf-c-button pf-m-plain" type="button" aria-label="Settings">
          <i class="fas fa-cog" aria-hidden="true"></i>
        </button>
      </div>
      <div class="pf-c-page__header-tools-item pf-m-hidden pf-m-visible-on-lg">
        <button class="pf-c-button pf-m-plain" type="button" aria-label="Help">
          <i class="pf-icon pf-icon-help" aria-hidden="true"></i>
        </button>
      </div>
      -->
    </div>
    <div class="pf-c-page__header-tools-group">
      <div class="pf-c-page__header-tools-item">
        <div class="pf-c-dropdown">
          <button class="pf-c-dropdown__toggle pf-m-plain" type="button" id="userDropdown" aria-expanded="false"
            aria-haspopup="true" data-toggle="dropdown">
            <span class="pf-c-dropdown__toggle-text userNameData">{{ Auth::user()->name }}</span>
            <span class="pf-c-dropdown__toggle-icon">
              <i class="fas fa-caret-down" aria-hidden="true"></i>
            </span>
          </button>
          <div class="pf-c-dropdown__menu dropdown-menu" aria-labelledby="userDropdown">
            <a class="dropdown-item pf-c-dropdown__item pf-c-button pf-m-primary pf-m-block" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
    @if(Auth::user()->provider == "internal")
    <img class="pf-c-avatar" src="https://www.gravatar.com/avatar/{{ md5(trim(Auth::user()->email)) }}" alt="{{ Auth::user()->name }}'s Avatar image" />
    @else
    <img class="pf-c-avatar" src="{{ Auth::user()->provider_avatar }}" alt="{{ Auth::user()->name }}'s Avatar image" />
    @endif
  </div>
</header>