<div  class="pull-left" id="users" style="margin-left: 12px;">
    <select class="form-control selectpicker"  title="Choose one of the following category" >
        @foreach(\Auth::user()->conversations()->get() as $user)
            <option value="{{ $user->users->first()->id }}">{{ $user->users->first()->fullname() }}</option>
        @endforeach
    </select>
</div>