@include('errors.alerts')

@if($type=='create')
{!! Form::open(['route' => 'book.store']) !!}
@else
{!! Form::model($book, [
    'method' => 'PATCH',
    'route' => ['book.update', $book->id]
]) !!}
@endif

    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', $book->title, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('isbn', 'ISBN:') !!}
        {!! Form::text('isbn', $book->isbn, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('price', 'Price:') !!}
        {!! Form::text('price', $book->price, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('stock', 'Stock:') !!}
        {!! Form::text('stock', $book->stock, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description', $book->description, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}