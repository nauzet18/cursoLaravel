@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{trans('author.edit_author')}}: {{$author->nombre }} {{$author->apellidos }}</div>

        <div class="panel-body">

          @include('errors.alerts')

          {!! Form::model($author, ['method' => 'PATCH','route' => ['author.update', $author->id]]) !!}

          @include('author._form', ['type' => 'edit'])

          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
@endsection