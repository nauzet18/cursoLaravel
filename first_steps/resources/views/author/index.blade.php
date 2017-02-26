@extends('app')
@section('content')
<div class="container">
    @include('errors.alerts')

    @if (Session::has('deleted'))
      <div class="alert alert-warning" role="alert"> Autor borrado, si desea deshacer el cambio <a href="{{ route('author/restore', [Session::get('deleted')]) }}">Click aqui</a> </div>
    @endif

    @if (Session::has('restored'))
      <div class="alert alert-success" role="alert"> Autor restaurado</div>
    @endif

    <div class="row">
     {!! Form::open(['route' => 'author/search', 'method' => 'post', 'novalidate', 'class' => 'form-inline']) !!}
      <div class="form-group">
        <label for="exampleInputName2">DNI</label>
        <input type="text" class="form-control" name = "dni" >
      </div>
      <button type="submit" class="btn btn-default">Search</button>
      <a href="{{ route('author.index') }}" class="btn btn-primary">All</a>
      <a href="{{ route('author.create') }}" class="btn btn-primary">Create</a>
      <div class="pull-right">
        Número total de autores: {#{$count}#}
      </div>
    {!! Form::close() !!}
      <br>
      <table class="table table-condensed table-striped table-bordered">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>DNI</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($authors as $author)
          <tr>
            <td>{{ $author->nombre }}</td>
            <td>{{ $author->apellidos }}</td>
            <td>{{ $author->dni }}</td>
            <td>{{ $author->email }}</td>
            <td>
              <a class="btn btn-primary btn-xs" href="{{ route('author.edit',['id' => $author->id] )}}" >Edit</a> 
              <a class="btn btn-danger btn-xs" href="{{ route('author/destroy',['id' => $author->id] )}}" >Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
@endsection