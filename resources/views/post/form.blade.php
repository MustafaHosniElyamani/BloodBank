
<div class="form-group">
    <label for="title">title</label>
    {!! Form::text('title',null,[
        'class' => 'form-control '
    ]) !!}
</div>

<div class="form-group">
    <label for="content">content</label>
    {!! Form::text('content',null,[
        'class' => 'form-control '
    ]) !!}
</div>
<div class="form-group">
    <label for="image">image</label>
    {!! Form::file('image', [  'class' => 'form-control ' ]) !!}
</div>
<div class="form-group">
    {!! Form::label('category_id', 'category') !!}
    {!! Form::select('category_id', $category->pluck('name', 'id'), null, ['class' => 'form-control', 'required', 'placeholder' => 'Select a category']) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">submit</button>
</div>
{!! Form::close() !!}
