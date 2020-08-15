@extends('layouts.pf4-primary')

@section('pageTitle', 'Dashboard')

@section('headerScripts')
  <style rel="stylesheet">
    #highlights h1 {
      font-size:1.25rem;
      font-weight:bold;
    }
    .render-range {
      font-weight: bold;
      margin-left:1rem;
    }
    .tui-full-calendar-popup-section {
      min-height: auto;
    }
    .tui-full-calendar-popup-detail .tui-full-calendar-content {
      height: auto;
    }
    .tui-full-calendar-weekday-grid-more-schedules {
      color: crimson !important;
      font-weight: 900 !important;
    }
  </style>
@endsection

@section('content')


<div class="pf-l-gallery pf-m-gutter" id="highlights">
  <div class="pf-l-gallery__item">
    <div class="pf-c-card">
      <div class="pf-c-card__body">
        <h1 class="pf-u-mr-xl pf-u-float-left">{{ \App\Workshop::all()->count() }} Workshops</h1>
      </div>
    </div>
  </div>
  <div class="pf-l-gallery__item">
    <div class="pf-c-card">
      <div class="pf-c-card__body"><h1 class="pf-u-mr-xl pf-u-float-left">{{ $currentEvents }} Current Events</h1></div>
    </div>
  </div>
  <div class="pf-l-gallery__item">
    <div class="pf-c-card">
      <div class="pf-c-card__body"><h1 class="pf-u-mr-xl pf-u-float-left">{{ $previousEvents }} Previous Events</h1></div>
    </div>
  </div>
  <div class="pf-l-gallery__item">
    <div class="pf-c-card">
      <div class="pf-c-card__body"><h1 class="pf-u-mr-xl pf-u-float-left">{{ $upcommingEvents }} Upcoming Events</h1></div>
    </div>
  </div>
  <div class="pf-l-gallery__item">
    <div class="pf-c-card">
      <div class="pf-c-card__body"><h1 class="pf-u-mr-xl pf-u-float-left">{{ \App\Student::all()->count() }} Unique Students</h1></div>
    </div>
  </div>
</div>

<hr class="pf-u-mt-xl pf-u-mb-xl" />

<div id="calendar-menu" class="pf-u-mb-md">
  <span id="menu-navi">
    <button type="button" class="pf-c-button pf-m-secondary pf-m-small move-today" data-action="move-today">Today</button>
    <button type="button" class="pf-c-button pf-m-tertiary pf-m-small move-month-prev" data-action="move-prev">
      &larr;
    </button>
    <button type="button" class="pf-c-button pf-m-tertiary pf-m-small move-month-next" data-action="move-next">
      &rarr;
    </button>
  </span>
  <span id="renderRange" class="render-range"></span>
</div>

<div id="calendar"></div>

<hr class="pf-u-mt-xl pf-u-mb-xl" />


<strong>Todo:</strong>
<ul>
  <li>Current Active Students</li>
</ul>

@endsection

@section('footerScripts')
<script type="text/javascript">

  function setCalendarTitleText() {
    jQuery("#calendar-menu #renderRange").text('Month of ' + moment(cal.getDate().toDate()).format('MMMM YYYY'));
  }
  var original_bgColors = [
    "#001f3f",
    "#0074D9",
    "#7FDBFF",
    "#39CCCC",
    "#3D9970",
    "#2ECC40",
    "#01FF70",
    "#FFDC00",
    "#FF851B",
    "#FF4136",
    "#85144b",
    "#F012BE",
    "#B10DC9",
    "#111111",
    "#AAAAAA",
    "#DDDDDD",
  ];
  var original_textColors = [
    "#80bfff",
    "#b3dbff",
    "#004966",
    "#000000",
    "#163728",
    "#0e3e14",
    "#00662c",
    "#665800",
    "#663000",
    "#800600",
    "#eb7ab1",
    "#65064f",
    "#efa9f9",
    "#dddddd",
    "#aaaaaa",
    "#000000",
  ];
  var bgColors = original_bgColors;
  var textColors = original_textColors;
  // register calendar templates
  var templates = {
    popupIsAllDay: function() {
      return 'All Day';
    },
    popupStateFree: function() {
      return 'Free';
    },
    popupStateBusy: function() {
      return 'Busy';
    },
    titlePlaceholder: function() {
      return 'Subject';
    },
    locationPlaceholder: function() {
      return 'Location';
    },
    startDatePlaceholder: function() {
      return 'Start date';
    },
    endDatePlaceholder: function() {
      return 'End date';
    },
    popupSave: function() {
      return 'Save';
    },
    popupUpdate: function() {
      return 'Update';
    },
    popupDetailDate: function(isAllDay, start, end) {
      //console.log(end);

      //return ('<i class="fa fa-clock pf-u-mr-sm"></i><strong>Start:</strong> ' + moment(start).format('YYYY.MM.DD hh:mm a') + '<br/>' + '<strong style="margin-left:20px;">End:</strong> ' + moment(end).format('YYYY.MM.DD hh:mm a'));
    },
    popupDetailBody: function(schedule) {
      var HTMLreturn = '<i class="fa fa-fw fa-clock pf-u-mr-sm"></i><strong>Start:</strong> ' + moment(schedule.raw.start).format('MMMM Do, YYYY @ hh:mm a Z') + '<br/>' + '<i class="fa fa-fw pf-u-mr-sm"></i><strong>End:</strong> ' + moment(schedule.raw.end).format('MMMM Do, YYYY @ hh:mm a Z') + 
              '<br /><i class="fa fa-fw fa-user pf-u-mr-sm"></i><strong>Created by</strong>: <a href="/panel/admin/users/show/' + schedule.raw.user.id + '">' + schedule.raw.user.name + '</a>';
              if (schedule.raw.description) {
                HTMLreturn = HTMLreturn + '<br /><i class="fa fa-fw fa-comment-alt pf-u-mr-sm"></i><strong>Description</strong>: ' + schedule.raw.description;
              }
              HTMLreturn = HTMLreturn + '<br /><i class="fa fa-fw fa-low-vision pf-u-mr-sm"></i><strong>Privacy</strong>: ' + schedule.raw.privacy_level +
              '<br /><i class="fa fa-fw fa-users pf-u-mr-sm"></i><strong>Seat Count</strong>: ' + schedule.raw.seat_count +
              '<br /><i class="fa fa-fw fa-cubes pf-u-mr-sm"></i><strong>Workshop</strong>: <a href="/panel/workshops/show/' + schedule.raw.workshop.id + '">' + schedule.raw.workshop.name + '</a>' +
              '<br /><i class="fa fa-fw fa-rocket pf-u-mr-sm"></i><strong>Event ID</strong>: '+ schedule.raw.event_id + '</a>';
      return HTMLreturn;
    },
    popupDetailLocation: function(schedule) {
      return 'Location : ' + schedule.location;
    },
    popupDetailUser: function(schedule) {
      //return '<strong>User</strong>: <a href="/panel/admin/users/show/' + schedule.attendees.id + '">' + schedule.attendees.name + '</a>';
    },
  };
  var cal = new Calendar('#calendar', {
    defaultView: 'month', // monthly view option
    isReadOnly: true,
    month: {
      visibleScheduleCount: 4,
      narrowWeekend: true // weekend column narrows to 1/2 width
    },
    template: templates,
    useCreationPopup: false,
    useDetailPopup: true,
    usageStatistics: false,
  });
  cal.on('afterRenderSchedule', function(event) {
    if (bgColors.length == 0) {
      bgColors = original_bgColors;
      textColors = original_textColors;
    }
    setCalendarTitleText();
  });
  cal.createSchedules([
    @foreach($events as $event)
    {
        id: '{{ $event->id }}',
        calendarId: '{{ $event->id }}',
        title: '{{ $event->event_title }}',
        raw: {
          description: '{{ $event->description }}',
          user: {
            id: '{{ $event->user_id }}',
            name: '{{ $event->user()->first()->name }}',
          },
          start: '{{ $event->start_time_long }}',
          end: '{{ $event->end_time_long }}',
          event_id: '{{ $event->event_id }}',
          seat_count: '{{ $event->seat_count }}',
          privacy_level: '{{ $event->privacy_description }}',
          workshop: {
            id: '{{ $event->workshop_id }}',
            name: '{{ $event->workshop()->first()->name }}'
          }
        },
        bgColor: bgColors.shift(),
        color: textColors.shift(),
        body: 'lolwut',
        category: 'time',
        start: '{{ $event->start_time_long }}',
        end: '{{ $event->end_time_long }}'
    },
    @endforeach
  ]);
  setCalendarTitleText();

  jQuery("#calendar-menu").on('click', '.move-today', function(e) {
    e.preventDefault();
    cal.today();
    setCalendarTitleText();
  });

  jQuery("#calendar-menu").on('click', '.move-month-next', function(e) {
    e.preventDefault();
    cal.next();
    setCalendarTitleText();
  });

  jQuery("#calendar-menu").on('click', '.move-month-prev', function(e) {
    e.preventDefault();
    cal.prev();
    setCalendarTitleText();
  });
</script>
@endsection