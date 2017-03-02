@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Create author</div>

        <div class="panel-body">

          @include('errors.alerts')

          {!! Form::open(['route' => 'author.store']) !!}

          @include('author._form', ['type' => 'create'])

          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
@endsection