
    @foreach($conversations as $conversation)
    <a href="/messages/?conversation={{$conversation->name}}" id="{{ $conversation->name }}" class="list-group-item {{ Session::get('current_conversation') == $conversation->name  ? 'active' : '' }}">

        <div class="list-group-status status-online"></div>

        <img src="{{ $conversation->users->first()->image_path }}" class="pull-left" alt="{{ $conversation->users->first()->firstname }} {{ $conversation->users->first()->lastname }}">

        <span class="contacts-title">{{ $conversation->users->first()->firstname }} {{ $conversation->users->first()->lastname }}</span>

        <?php $last = $conversation->messages->last();?>

        <p>
            @if( $last->type == 'text')
                {{ Str::words($last->body, 5) }}
            @else
                {{ \App\Models\Fileentry::where('id', '=', $last->body)->firstOrFail()->original_filename }}
            @endif

            @if($conversation->messagesNotifications()->count() != 0)
            <span class="label label-danger">{{ $conversation->messagesNotifications()->count() }}</span>
            @endif
        </p>



    </a>
    @endforeach
