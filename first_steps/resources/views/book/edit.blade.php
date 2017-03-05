@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">{{trans('book.edit_book')}}: {{$book->title }}</div>

        <div class="panel-body">

          @include('errors.alerts')

          {!! Form::model($book, ['method' => 'PATCH','route' => ['book.update', $book->id]]) !!}

          @include('book._form', ['type' => 'edit'])

          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
@endsection