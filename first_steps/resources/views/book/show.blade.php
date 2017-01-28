@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Show book: {{$book->title }}</div>

        <div class="panel-body">

          @include('errors.alerts')

          <div class="form-group">
              {!! Form::label('title', 'Title:') !!}
              {{$book->title }}
          </div>

          <div class="form-group">
              {!! Form::label('isbn', 'ISBN:') !!}
              {{$book->isbn }}
          </div>

          <div class="form-group">
              {!! Form::label('price', 'Price:') !!}
              {{$book->isbn }}
          </div>

          <div class="form-group">
              {!! Form::label('stock', 'Stock:') !!}
              {{$book->stock }}
          </div>

          <div class="form-group">
              {!! Form::label('description', 'Description:') !!}
              {{$book->description }}
          </div>



        </div>
      </div>
    </div>
  </div>
</div>
@endsection