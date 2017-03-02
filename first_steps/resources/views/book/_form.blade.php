<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('isbn', 'ISBN:') !!}
    {!! Form::text('isbn', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::text('stock', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('author', 'Author') !!}
    {!! Form::select('author', null, ['class' => 'form-control'])  !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}