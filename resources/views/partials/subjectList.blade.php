<select class="form-control selectpicker"  title="Choose one of the following category" >
      <option value="{{ $id }}">{{ $current }}</option>
    @foreach(\App\Models\Subject::all() as $subject)
        @if($subject->id != $id)
        <option value="{{ $subject->id }}">{{ $subject->subjects }}</option>
        @endif
    @endforeach
</select>