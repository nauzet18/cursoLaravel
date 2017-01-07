@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Create book</div>

        <div class="panel-body">
          
          @include('book._form', ['type' => 'create'])

        </div>
      </div>
    </div>
  </div>
</div>
@endsection