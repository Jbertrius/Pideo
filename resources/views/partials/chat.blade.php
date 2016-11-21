
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
        @elseif($message->type == 'pideo')
            <?php
                $pideo =  \App\Models\Pideo::where('id', '=', $message->body)->firstOrFail();
                $filename =  str_replace('.mp4', '.jpg', $pideo->filename);
            ?>
            <div class="text video" @if($message->user->id == $userId) style="margin-right: 12px;" @endif >
                        <img src="/images/{{ $filename }}/0" class="frame" style="height: 100px; ">
                 <span class="fa fa-4x fa-play-circle-o playsign2" data-url = "/pideos/{{ $pideo->filename }}" data-modal-id="modal-video"></span>
             </div>
        @endif



    </div>
    @endforeach

