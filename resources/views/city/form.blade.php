<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name', null, [
        'class' => 'form-control ',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('governorate_id', 'Governorate') !!} {{-- just for send , it reads from pluck assocaited with id --}}
    {!! Form::select('governorate_id', $governorate->pluck('name', 'id'), null, ['class' => 'form-control', 'required', 'placeholder' => 'Select a Governorate']) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">submit</button>
</div>
{!! Form::close() !!}
