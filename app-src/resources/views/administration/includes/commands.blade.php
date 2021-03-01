@if($artisan_output)
    <pre>
        <i class="close-output voyager-x">Clear Output</i><span class="art_out">Command Output:</span>{{ trim(trim($artisan_output,'"')) }}
    </pre>
@endif
@php
$count = 0;
@endphp
@foreach($commands as $command)
    <div class="command" data-command="{{ $command->name }}">
        <code>php artisan {{ $command->name }}</code>
        <small>{{ $command->description }}</small><i class="voyager-terminal"></i>
        <form action="{{ route('panel.post.administration.command') }}" class="cmd_form" method="POST">
            {{ csrf_field() }}
            <input type="text" name="args" autofocus class="form-control" placeholder="Additional arg...">
            <input type="submit" class="btn btn-primary pull-right delete-confirm"
                    value="Run">
            <input type="hidden" name="command" id="hidden_cmd{{ $count }}" value="{{ $command->name }}">
        </form>
    </div>
@php
$count++;
@endphp
@endforeach