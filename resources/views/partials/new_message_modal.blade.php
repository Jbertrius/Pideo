<div class="modal-dialog">
    {{ Form::open( array('action' => 'ConversationController@store', 'id' => 'form')) }}
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="defModalHead">New Message</h4>
        </div>
        <div class="modal-body" >
            <div class="form-group">
                <label class="col-md-2 control-label">To</label>
                <div class="col-md-10" style="margin-bottom: 12px; margin-top: -7px;">
                    <p class="form-control-static">{{ $firstname }} {{ $lastname }}</p>
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-2 control-label">Message</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="body" id="messageBox"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onclick="send();" class="btn btn-primary">Send</button>
        </div>
    </div>
    <input type="hidden" name="id" id="id" value="{{ $id }}">
    {{ Form::close() }}
</div>
