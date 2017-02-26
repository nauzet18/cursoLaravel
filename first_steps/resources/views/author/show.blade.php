@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Show author: {{$author->nombre }} {{$author->apellidos }}</div>

        <div class="panel-body">

          @include('errors.alerts')

          <div class="form-group">
              {!! Form::label('nombre', 'Nombre:') !!}
              {{$author->nombre }}
          </div>

          <div class="form-group">
              {!! Form::label('apellidos', 'Apellidos:') !!}
              {{$author->apellidos }}
          </div>

          <div class="form-group">
              {!! Form::label('dni', 'DNI') !!}
              {{$author->dni }}
          </div>

          <div class="form-group">
              {!! Form::label('email', 'Email:') !!}
              {{$author->email }}
          </div>

          <div class="form-group">
              {!! Form::label('birth_date', 'Price:') !!}
              {{$author->birth_date }}
          </div>

          <div class="form-group">
              {!! Form::label('notas', 'Notas:') !!}
              {{$author->notas }}
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection