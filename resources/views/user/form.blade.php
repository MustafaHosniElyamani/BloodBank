
<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name',null,[
        'class' => 'form-control '
    ]) !!}
</div>

<div class="form-group">
    <label for="email">email</label>
    {!! Form::email('email',null,[
        'class' => 'form-control '
    ]) !!}
</div>

<div class="form-group">
    <label for="password">password</label>
    {!! Form::password('password', [
        'class' => 'form-control '
    ]) !!}
</div>
<div class="form-group">
    <label for="password_confirmation">password confirmation</label>
    {!! Form::password('password_confirmation', [
        'class' => 'form-control '
    ]) !!}
</div>

{{-- <div class="form-group">
        <label for="">Roles:</label>
        <br>

    @foreach ($rls->all() as $role)
    {!! Form::checkbox('roles[]', $role->id,in_array($role->id, $model->roles->pluck('id')->toArray()),['id' => 'role-' . $role->id] ) !!}
    {!! Form::label('role-' . $role->id, $role->name) !!}<br>
    @endforeach
</div> --}}
<div class="form-group">
    <label for="">Roles:</label>
    <br>
    {!! Form::select('roles[]', $rls->pluck('name', 'id'), null, ['class' => 'form-control', 'id' => 'roles-select', 'multiple' => 'multiple']) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">submit</button>
</div>
{!! Form::close() !!}
