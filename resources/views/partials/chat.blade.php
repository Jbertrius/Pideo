
    @foreach($messages as $message)
    <div class="item item-visible @if($message->user->id == $userId)in @endif">
        <div class="image">
            <img src="{{ $message->user->image_path }}" alt="{{ $message->user->firstname }} {{ $message->user->lastname }}">
        </div>
        @if($message->type == 'text')
        <div class="text">
            <div class="heading">
                <a href="#">{{ $message->user->firstname }} {{ $message->user->lastname }}</a>
                <span class="date">{{ $message->created_at }}</span>
            </div>
            {{ $message->body }}
        </div>
        @elseif($message->type == 'pic')
                <div class="text boxpic">
                      <?php
                        $file = \App\Models\Fileentry::where('id', '=', $message->body)->firstOrFail();
                        $url = 'images/'.$file->filename;?>

                     <div class="gallery" id="links">
                        <a href="{{ $url.'/0' }} " title=" {{ $file->original_filename }} " class="gallery-item apic" data-gallery>
                            <div class="image imagebox">
                                <img src="{{ $url.'/1' }} "  alt=" {{ $file->original_filename }} " class="img"/>
                            </div>
                        </a>
                     </div>

                </div>
        @elseif($message->type == 'file')
            <?php
            $file = \App\Models\Fileentry::where('id', '=', $message->body)->firstOrFail();
            $url = "/files/".$file->filename;
            ?>
                <div class="text" >
                     <a href="{{ $url }}" @if($message->user->id == $userId) style="color: white" @endif>{{ $file->original_filename }}</a>
                </div>
        @endif



    </div>
    @endforeach

