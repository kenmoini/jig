
<div class="col-sm-3 col-md-3 sidebar">
  <div class="list-group">
    @foreach($files as $file)
      <a href="?log={{ base64_encode($file) }}"
         class="list-group-item @if ($current_file == $file) llv-active @endif">
        <i class="voyager-file-text"></i> {{$file}}
      </a>
    @endforeach
  </div>
</div>
<div class="col-sm-9 col-md-9 table-container">
  @if ($logs === null)
    <div>
      Sorry!  This file is too big!
    </div>
  @else
    <table id="table-log" class="table table-striped pf-c-table pf-m-grid-lg" role="grid">
      <thead>
      <tr role="row">
        <th class="pf-c-table__sort">Level</th>
        <th class="pf-c-table__sort">Context</th>
        <th class="pf-c-table__sort">Date</th>
        <th class="pf-c-table__sort">Content</th>
      </tr>
      </thead>
      <tbody>

      @foreach($logs as $key => $log)
        <tr data-display="stack{{{$key}}}">
          <td class="text-{{{$log['level_class']}}} level"><span class="glyphicon glyphicon-{{{$log['level_img']}}}-sign"
                                                           aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
          <td class="text">{{$log['context']}}</td>
          <td class="date">{{{$log['date']}}}</td>
          <td class="text">
            @if ($log['stack']) <a class="pull-right expand btn btn-default btn-xs"
                                   data-display="stack{{{$key}}}"><span
                  class="glyphicon glyphicon-search"></span></a>@endif
            {{{$log['text']}}}
            @if (isset($log['in_file'])) <br/>{{{$log['in_file']}}}@endif
            @if ($log['stack'])
              <div class="stack" id="stack{{{$key}}}"
                   style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
              </div>@endif
          </td>
        </tr>
      @endforeach

      </tbody>
    </table>
  @endif
  <div id="logActionsFooter">
    @if($current_file)
      <a href="?download={{ base64_encode($current_file) }}"><span class="glyphicon glyphicon-download-alt"></span>
        Download File</a>
      -
      <a id="delete-log" href="?del={{ base64_encode($current_file) }}"><span
            class="glyphicon glyphicon-trash"></span> Delete File</a>
      @if(count($files) > 1)
        -
        <a id="delete-all-log" href="?delall=true"><span class="glyphicon glyphicon-trash"></span> Delete ALL Files</a>
      @endif
    @endif
  </div>
</div>