@extends('app')
@section('content')
<div class="container">
    @include('errors.alerts')

    @if (Session::has('deleted'))
      <div class="alert alert-warning" role="alert"> Libro borrado, si desea deshacer el cambio <a href="{{ route('book/restore', [Session::get('deleted')]) }}">Click aqui</a> </div>
    @endif

    @if (Session::has('restored'))
      <div class="alert alert-success" role="alert"> Libro restaurado</div>
    @endif

    <div class="row">
     {!! Form::open(['route' => 'book/search', 'method' => 'post', 'novalidate', 'class' => 'form-inline']) !!}
      <div class="form-group">
        <label for="exampleInputName2">Title</label>
        <input type="text" class="form-control" name = "title" >
      </div>
      <button type="submit" class="btn btn-default">Search</button>
      <a href="{{ route('book.index') }}" class="btn btn-primary">All</a>
      <a href="{{ route('book.create') }}" class="btn btn-primary">Create</a>
      <div class="pull-right">
        Número total de libros: {{$count}}
      </div>
    {!! Form::close() !!}
      <br>
      <table class="table table-condensed table-striped table-bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>ISBN</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>  
          </tr>
        </thead>
        <tbody>
          @foreach($books as $book)
          <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->price }}</td>
            <td>{{ $book->stock }}</td>
            <td>
              <a class="btn btn-primary btn-xs" href="{{ route('book.edit',['id' => $book->id] )}}" >Edit</a> 
              <a class="btn btn-danger btn-xs" href="{{ route('book/destroy',['id' => $book->id] )}}" >Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
@endsection