@extends('layouts.pf4-primary')

@section('pageTitle', 'Administration - Overview')

@section('content')
<div class="pf-c-card" id="card-no-footer-example">
  <div class="pf-c-card__title">
    <div class="pf-c-tabs pf-m-box pf-m-fill" id="adminTabHolder">
      <button class="pf-c-tabs__scroll-button" disabled aria-hidden="true" aria-label="Scroll left">
        <i class="fas fa-angle-left" aria-hidden="true"></i>
      </button>
      <ul class="pf-c-tabs__list nav nav-tabs" role="tablist" id="adminTabList">
        <li class="pf-c-tabs__item @if(empty($active_tab) || (isset($active_tab) && $active_tab == 'general')){{ 'pf-m-current' }}@endif" role="presentation">
          <button class="pf-c-tabs__link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general">
            <span class="pf-c-tabs__item-text">General</span>
          </button>
        </li>
        <li class="pf-c-tabs__item @if($active_tab == 'commands'){{ 'pf-m-current' }}@endif" role="presentation">
          <button class="pf-c-tabs__link" id="commands-tab" data-toggle="tab" href="#commands" role="tab" aria-controls="commands">
            <span class="pf-c-tabs__item-text">Commands</span>
          </button>
        </li>
        <li class="pf-c-tabs__item @if($active_tab == 'logs'){{ 'pf-m-current' }}@endif" role="presentation">
          <button class="pf-c-tabs__link" id="logs-tab" data-toggle="tab" href="#logs" role="tab" aria-controls="logs">
            <span class="pf-c-tabs__item-text">Logs</span>
          </button>
        </li>
      </ul>
      <button class="pf-c-tabs__scroll-button" disabled aria-hidden="true" aria-label="Scroll right">
        <i class="fas fa-angle-right" aria-hidden="true"></i>
      </button>
    </div>
  </div>
  <div class="pf-c-card__body">
    <div class="page-content compass container-fluid">

      <div class="tab-content">

        <div id="general" class="tab-pane fade in @if(empty($active_tab) || (isset($active_tab) && $active_tab == 'general')){!! 'show' !!}@endif" role="tabpanel" aria-labelledby="general-tab">
          <h3> General <small>General Administrative Information</small></h3>
          <div>
              GOOD STUFF RIGHT HERE
          </div>

        </div>

        <div id="commands" class="tab-pane fade in @if($active_tab == 'commands'){!! 'show' !!}@endif" role="tabpanel" aria-labelledby="commands-tab">
          <h3><i class="voyager-terminal"></i> Commands <small>Available PHP Artisan Commands</small></h3>
          <div id="command_lists">
              @include('administration.includes.commands')
          </div>

        </div>
        <div id="logs" class="tab-pane fade in @if($active_tab == 'logs'){!! 'show' !!}@endif" role="tabpanel" aria-labelledby="logs-tab">
          <h3>Logs <small>Because Kubernetes is hard.</small></h3>
          <div class="row" id="logsHolder">

              @include('administration.includes.logs')

          </div>
        </div>
      </div>

    </div>
    
  </div>
</div>


    

@endsection

@section('headerScripts')
<style type="text/css">
  .tab-content .tab-pane {
    display: none;
  }
  .tab-content .tab-pane.show {
    display: inherit;
  }
  #adminTabList button:active, #adminTabList button:hover, #adminTabList button:focus {
    outline: none;
  }
  .tab-pane > h3{
    font-size: 1.5rem;
  }
  /*
  .voyager .compass .nav-tabs{
      background:none;
      border-bottom:0px;
  }

  .voyager .compass .nav-tabs > li{
      margin-bottom:-1px !important;
  }

  .voyager .compass .nav-tabs a{
      text-align: center;
      font-size: 10px;
      font-weight: normal;
      background: #f8f8f8;
      border: 1px solid #f1f1f1;
      position: relative;
      top: -1px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }

  .voyager .compass .nav-tabs a i{
      display: block;
      font-size: 22px;
  }

  .tab-content{
      background:#ffffff;
      border: 1px solid transparent;
      border-radius: 4px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }

  .page-content{
      z-index:2;
      position:relative;
  }
  */

  .page-title{
      height:85px;
      z-index:2;
      position:relative;
  }

  .page-title p{
      height: 20px;
      margin-bottom: 0px;
      padding-top: 0px;
      position: relative;
      top: -10px;
  }

  .page-title span{
      font-size: 10px;
      font-weight: normal;
      top: -12px;
      position: relative;
  }

  .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover{
      background:#fff !important;
      color:#62a8ea !important;
      border-bottom:1px solid #fff !important;
      top:-1px !important;
  }

  .nav-tabs > li a{
      transition:all 0.3s ease;
  }


  .nav-tabs > li.active > a:focus{
      top:0px !important;
  }

  .voyager .compass .nav-tabs > li > a:hover{
      background-color:#fff !important;
  }

  .voyager-link{
      width: 100%;
      min-height: 220px;
      display: block;
      border-radius: 3px;
      background-position: center center;
      background-size: cover;
      position:relative;
  }

  .voyager-link span.resource_label{
      text-align: center;
      color: #fff;
      display: block;
      position: absolute;
      z-index: 9;
      top: 0px;
      left: 0px;
      width: 100%;
      padding: 0px;
      opacity:0.8;
      transition:all 0.3s ease;
      line-height: 220px;
      height: 100%;
  }

  .voyager-link span.resource_label:hover{
      opacity:1;
  }

  .voyager-link i{
      font-size: 48px;
      margin-right: 0px;
      position: absolute;
      width: 70px;
      height: 70px;
      padding: 10px;
      border-radius: 5px;
      line-height: 55px;
      display: inline-block;
      left: 50%;
      margin-top: -50px;
      margin-left: -35px;
      top: 50%;
      line-height:55px;
      padding:10px;
  }

  .voyager-link span.resource_label:hover i{
      
      opacity:1;
      transition:all 0.3s linear;
  }

  .voyager-link span.copy{
      position: absolute;
      font-size: 16px;
      left: 0px;
      bottom: 70px;
      line-height: 12px;
      text-transform: uppercase;
      text-align: center;
      width: 100%;
  }

  h3 small{
      font-size: 11px;
      position: relative;
      top: -3px;
      left: 10px;
      color: #999;
  }

  .collapsible{
      margin-top:20px;
      border:1px solid #f7f7f7;
      border-radius:3px;
      display:block;
  }

  .collapse-head{
      border-bottom: 1px solid #f7f7f7;
      border-top-right-radius: 3px;
      padding:5px 15px;
      display:block;
      cursor:pointer;
      background:#ffffff;
      position:relative;
  }

  .collapse-head:after{
      content:'';
      clear:both;
      display:block;
  }

  .collapse-head h4{
      float:left;
  }

  .collapse-head i{
      font-size: 16px;
      position: absolute;
      top: 13px;
      right:15px;
      float:right;
  }

  .collapse-content{
      padding:15px;
      background:#fcfcfc;
  }

  .collapse-content .row{
      padding-bottom:0px;
      margin-bottom:0px;
  }

  .collapse-content .col-md-4{
      padding-right:0px;
      margin-bottom:0px;
  }

  .collapse-content .col-md-4:nth-child(3){
      padding-right:15px;
  }

  .voyager-link span.desc{
      font-size:11px;
      color:rgba(255, 255, 255, 0.8);
      width:100%;
      height:100%;
      position:absolute;
      text-align:center;
  }

  .voyager-angle-down{
      display:none;
  }

  .voyager-link::after{
      content:'';
      position:absolute;
      width:100%;
      height:100%;
background: -moz-linear-gradient(-65deg, rgba(17,17,17,0.7) 0%, rgba(35,35,47,0.7) 50%, rgba(17,17,23,0.7) 51%, rgba(17,17,23,0.7) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(-65deg, rgba(17,17,17,0.7) 0%,rgba(35,35,47,0.7) 50%,rgba(17,17,23,0.7) 51%,rgba(17,17,23,0.7) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(155deg, rgba(17,17,17,0.7) 0%,rgba(35,35,47,0.7) 50%,rgba(17,17,23,0.7) 51%,rgba(17,17,23,0.7) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b3111111', endColorstr='#b3111117',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
      left:0px;
      top:0px;
      border-radius:3px;
  }

  #fonts ul{
      list-style:none;
      display:flex;
      padding-left:10px;
      flex-wrap:wrap;
      justify-content:flex-start;
  }

  #fonts .icon{
      float: left;
      padding: 2px;
      font-size: 20px;
      padding-right: 10px;
      position: absolute;
      left: 0px;
  }

  #fonts li{
      flex: 1;
      max-width:212px;
      padding: 10px;
      padding-left: 30px;
      position: relative;
  }

  #fonts .voyager-angle-down{
      display:block;
  }

  #fonts h2{
      font-size: 12px;
      padding: 20px;
      padding-top: 0px;
      font-weight: bold;
      padding-left:5px;
  }

  #fonts h2:nth-child(2){
      padding-top:20px;
  }

  #fonts input{
      border-radius: 3px;
      border: 1px solid #f1f1f1;
      padding: 3px 7px;
  }

  #logs .level .glyphicon{
      float:left;
  }

  #logs table.dataTable thead th.sorting:after{
      top:13px;
  }

  #logs table.dataTable thead .sorting_asc:after{
      top:12px;
  }

  #logs .table-container{
      margin-top:20px;
  }

  #logs .list-group{
      margin:2rem 0;
      border-bottom:1px solid;
  }

  #logs .list-group-item{
      background: #EEE;
      border: none;
      border-radius: 0;
      font-size: 1rem;
      font-weight: normal;
      color: #000;
      padding:2px 10px;
      border-bottom: 1px solid;
      border-top: 1px solid #FFF;
  }


  #logs .list-group-item.llv-active {
      border:1px solid;
      background:#FFF;
      font-weight:bold;
      padding:4px 10px;
      border-bottom: 0px solid #000;
      border-top: #06c 2px solid;
  }


  .voyager #logs .table>thead>tr>th:first-child{
      
  }

  .voyager #logs .table>thead>tr>th:last-child{
      
    border-right:none;
  }

  #logs .list-group-item i{
      position: relative;
      top: 2px;
      left: -3px;
  }

  #logs .list-group-item.llv-active:hover{
      border:1px solid;
      background:#FFF;
      font-weight:bold;
      padding:4px 10px;
      border-bottom: 0px solid #000;
      border-top: #06c 2px solid;
  }

  #logs .list-group-item:hover{
      background: #DDD;
      border-top: #BBB 2px solid;
  }

  #logs .list-group-item.llv-active:after, #logs .list-group-item.llv-active:before, #logs .list-group-item:hover:after, #logs .list-group-item:hover:before{
      content:'';
      position:absolute;
      width:100%;
      height:1px;
      left:0px;
      background: rgb(241,241,241); /* Old browsers */
      background: -moz-linear-gradient(left, rgba(241,241,241,1) 0%, rgba(255,255,255,1) 100%); /* FF3.6-15 */
      background: -webkit-linear-gradient(left, rgba(241,241,241,1) 0%,rgba(255,255,255,1) 100%); /* Chrome10-25,Safari5.1-6 */
      background: linear-gradient(to right, rgba(241,241,241,1) 0%,rgba(255,255,255,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1f1f1', endColorstr='#ffffff',GradientType=1 ); /* IE6-9 */
  }

  #logs .list-group-item.llv-active:before, #logs .list-group-item:hover:before{
      top:0px;
  }

    #logs .list-group-item.llv-active:after, #logs .list-group-item:hover:after{
      bottom: 0px;
      z-index: 9;
    }

    #command_lists{
      display:flex;
      flex-wrap:wrap;
    }

    #commands h3{
      width: 100%;
      clear: both;
      margin-bottom: 20px;
    }

    #commands h3 i{
      position: relative;
      top: 3px;
    }

    #commands .command{
      padding: 10px;
      border: 1px solid #f1f1f1;
      border-radius: 4px;
      border-bottom: 2px solid #f5f5f5;
      cursor:pointer;
      transition:all 0.3s ease;
      position:relative;
      padding-top:30px;
      padding-right: 52px;
      flex:1;
      min-width:275px;
      margin:10px;
      margin-left:0px;
    }

    #commands .command.more_args{
      padding-bottom:40px;
    }

    #commands .command i{
      position: absolute;
      right: 4px;
      top: -6px;
      font-size: 45px;
    }

    #commands code{
      color: #549DEA;
      padding: 4px 7px;
      font-weight: normal;
      font-size: 12px;
      background: #f3f7ff;
      border: 0px;
      position: absolute;
      top: 0px;
      left: 0px;
      border-bottom-left-radius: 0px;
      border-top-right-radius: 0px;
    }

    #commands .command:hover{
      border-color:#eaeaea;
      border-bottom-width:2px;
    }

    .cmd_form{
      display:none;
      position:absolute;
      bottom: 0px;
      left: 0px;
      width: 100%;
  }

  .cmd_form input[type="text"], .cmd_form input[type="submit"]{
      width:30%;
      float:left;
      margin: 0px;
      font-size: 12px;
  }

  .cmd_form input[type="text"]{
      line-height: 30px;
      padding-top: 0px;
      padding-bottom: 0px;
      height: 30px;
      border-top-right-radius: 0px;
      border-bottom-right-radius: 0px;
      border-top-left-radius:0px;
      padding-left:5px;
      font-size:12px;
      width:70%;
  }

  .cmd_form .form-control.focus, .cmd_form .form-control:focus{
      border-color:#eee;
  }

  .cmd_form input[type="submit"]{
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-top-left-radius:0px;
      font-size: 10px;
      padding-left: 7px;
      padding-right: 7px;
      height: 30px;
  }
    

    #commands pre{
      background:#323A42;
      color:#fff;
      width:100%;
      margin:10px;
      margin-left:0px;
      padding: 15px;
      padding-top: 0px;
      padding-bottom: 0px;
      position:relative;
    }

    #commands .close-output{
      position:absolute;
      right:15px;
      top:15px;
      color:#ccc;
      cursor:pointer;
      padding: 5px 14px;
      background: rgba(0, 0, 0, 0.2);
      border-radius: 25px;
      transition:all 0.3s ease;
    }

    #commands .close-output:hover{
      color:#fff;
      background: rgba(0, 0, 0, 0.3);
    }

    #commands pre i:before{
      position:relative;
      top:3px;
      right:5px;
    }

    #commands pre .art_out{
      width: 100%;
      display: block;
      color: #98cb00;
      margin-bottom:10px;
    }

    .dataTables_filter, .dataTables_paginate {
      display: inline-block;
      float: right;
    }
    .dataTables_length, .dataTables_info {
      display: inline-block;
    }
    .dataTables_info, .dataTables_paginate {
      margin: 1rem 0;
    }
    table.dataTable {
      margin:2rem 0 1rem;
      padding:1rem 0;
      border-top:1px solid;
      border-bottom:1px solid;
    }
    #logActionsFooter {
      background: #EEE;
      padding:1rem;
      margin-top:1rem;
    }
</style>
@endsection

@section('footerScripts')
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#adminTabList li button').on('click', function (event) {
      event.preventDefault();
      // Remove styling from other tab buttons
      jQuery('#adminTabList li').removeClass('pf-m-current');
      // Add styling to this tab button
      jQuery(this).parent().addClass('pf-m-current');
      // Remove class from other tab content holders
      jQuery('.tab-content .tab-pane').removeClass('show');
      // Add class to this tab content holder
      jQuery(jQuery(this).attr('href')).addClass('show');

    })
  });
</script>
<!-- JS for commands -->
<script>

    $(document).ready(function(){
        $('.command').click(function(){
            $(this).find('.cmd_form').slideDown();
            $(this).addClass('more_args');
            $(this).find('input[type="text"]').focus();
        });

        $('.close-output').click(function(){
            $('#commands pre').slideUp();
        });
    });

</script>

<!-- JS for logs -->
<script>
  $(document).ready(function () {
    $('.table-container tr').on('click', function () {
      $('#' + $(this).data('display')).toggle();
    });
    $('#table-log').DataTable({
      "order": [1, 'desc'],
      "stateSave": true,
      "language": {!! json_encode(__('voyager::datatable')) !!},
      "stateSaveCallback": function (settings, data) {
        window.localStorage.setItem("datatable", JSON.stringify(data));
      },
      "stateLoadCallback": function (settings) {
        var data = JSON.parse(window.localStorage.getItem("datatable"));
        if (data) data.start = 0;
        return data;
      }
    });

    $('#delete-log, #delete-all-log').click(function () {
      return confirm('Are you sure?');
    });
  });
</script>

@endsection
