
<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name',null,[
        'class' => 'form-control '
    ]) !!}
</div>

<div class="form-group">
        <label for="">Permissions:</label>
        <br>

    @foreach ($perms->all() as $permission)
    {!! Form::checkbox('permissions[]', $permission->id,in_array($permission->id, $model->permissions->pluck('id')->toArray()),['id' => 'permission-' . $permission->id] ) !!}
    {!! Form::label('permission-' . $permission->id, $permission->name) !!}<br>
    @endforeach
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">submit</button>
</div>
{!! Form::close() !!}
