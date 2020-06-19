<div class="pf-c-page__sidebar collapse show" id="mainSideNav">
  <div class="pf-c-page__sidebar-body">
    <nav class="pf-c-nav" id="page-expandable-nav-example-expandable-nav" aria-label="Global">
      <ul class="pf-c-nav__list">


        <li class="pf-c-nav__item">
          <a class="pf-c-nav__link {{ Route::currentRouteName() == 'panel.get.dashboard.index' ? 'pf-m-current' : '' }}" href="{{ route('panel.get.dashboard.index') }}">Dashboard</a>
        </li>

        <li class="pf-c-nav__item">
          <a class="pf-c-nav__link {{ Route::currentRouteName() == 'panel.get.workshops.index' ? 'pf-m-current' : '' }}" href="{{ route('panel.get.workshops.index') }}">Workshops</a>
        </li>

        <li class="pf-c-nav__item">
          <a class="pf-c-nav__link {{ Route::currentRouteName() == 'panel.get.events.index' ? 'pf-m-current' : '' }}" href="{{ route('panel.get.events.index') }}">Events</a>
        </li>

        <li class="pf-c-nav__item">
          <a class="pf-c-nav__link {{ Route::currentRouteName() == 'panel.get.students.index' ? 'pf-m-current' : '' }}" href="{{ route('panel.get.students.index') }}">Students</a>
        </li>

        <li class="pf-c-nav__item">
          <a class="pf-c-nav__link {{ Route::currentRouteName() == 'panel.get.activity.index' ? 'pf-m-current' : '' }}" href="{{ route('panel.get.activity.index') }}">Activity Reports</a>
        </li>

        <li class="pf-c-nav__item pf-m-expandable">
          <a href="#" class="pf-c-nav__link" id="nav-admin-section-btn" aria-expanded="false" data-toggle="collapse" aria-controls="nav-admin-section" data-target="#nav-admin-section">Administration
            <span class="pf-c-nav__toggle">
              <span class="pf-c-nav__toggle-icon">
                <i class="fas fa-angle-right" aria-hidden="true"></i>
              </span>
            </span>
          </a>
          <section class="pf-c-nav__subnav collapse" aria-labelledby="nav-admin-section" id="nav-admin-section">
            <ul class="pf-c-nav__list">
              <li class="pf-c-nav__item">
                <a href="{{ route('panel.get.administration.index') }}" class="pf-c-nav__link {{ Route::currentRouteName() == 'panel.get.administration.index' ? 'pf-m-current' : '' }}">Overview</a>
              </li>
              <li class="pf-c-nav__item">
                <a href="{{ route('panel.get.users.index') }}" class="pf-c-nav__link {{ Route::currentRouteName() == 'panel.get.users.index' ? 'pf-m-current' : '' }}" aria-current="page">Users</a>
              </li>
              <li class="pf-c-nav__item">
                <a href="#" class="pf-c-nav__link">Roles</a>
              </li>
            </ul>
          </section>
        </li>

      </ul>
    </nav>
  </div>
</div>