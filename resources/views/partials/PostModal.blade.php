<div class="modal-dialog">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="defModalHead">Complete some information</h4>
        </div>
        <div class="modal-body fix-height" >

            <form>
            <div class="form-group">
                <label class="col-md-2 control-label">Description</label>
                <div class="col-md-10" style="margin-bottom: 12px; margin-top: -7px;">
                   <input class="form-control" name="title"  placeholder="Ex: First Law of Thermodynamics..." required="required"
                          data-validation-error-msg=" " id="title" type="text">
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-2 control-label">Category</label>
                <div class="col-md-10">
                <select class="form-control selectpicker"  title="Choose one of the following category" >
                    @foreach(\App\Models\Subject::getAll() as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subjects }}</option>
                    @endforeach
                </select>
                    </div>
            </div>

            </form>
        </div>
        <div class="modal-footer">



            <div class="text-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button"   class="btn btn-primary send-post">Send</button>
            </div>

        </div>
    </div>


</div>

