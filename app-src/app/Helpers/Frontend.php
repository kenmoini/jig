<?php

function displayAlert()
{

  // Session::flash('message-danger', 'This is a danger message!');
  // Session::flash('message-warning', 'This is an orange warning message!');
  // Session::flash('message-info', 'This is a simple info message!');
  // Session::flash('message-success', 'This is a successful message!');
  
  foreach (['danger', 'warning', 'success', 'info'] as $msg) {
    if(Session::has('message-' . $msg)) {
      
      echo '<div class="pf-c-alert pf-m-' . $msg . '">';
      switch ($msg) {
        case "danger":
          echo '<div class="pf-c-alert__icon"><i class="fas fa-fw fa-exclamation-circle" aria-hidden="true"></i></div>';
        break;
        case "warning":
          echo '<div class="pf-c-alert__icon"><i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i></div>';
        break;
        case "success":
          echo '<div class="pf-c-alert__icon"><i class="fas fa-fw fa-check-circle" aria-hidden="true"></i></div>';
        break;
        case "info":
          echo '<div class="pf-c-alert__icon"><i class="fas fa-fw fa-info-circle" aria-hidden="true"></i></div>';
        break;
      }
      echo Session::get('message-' . $msg);
      echo '</div>';
    }
  }

  return '';
}

function displayGitChecksum() {
  try {
    $gitChecksum = \File::get(storage_path('.gitchecksum'));
    echo substr(trim($gitChecksum), 0, 7);
  } catch (\Exception $e) {
    //echo "";
  }
}