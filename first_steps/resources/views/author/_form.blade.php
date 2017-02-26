@include('errors.alerts')

@if($type=='create')
{!! Form::open(['route' => 'author.store']) !!}
@else
{!! Form::model($author, [
    'method' => 'PATCH',
    'route' => ['author.update', $author->id]
]) !!}
@endif

    <div class="form-group">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', $author->nombre, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('apellidos', 'Apellidos:') !!}
        {!! Form::text('apellidos', $author->apellidos, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('dni', 'DNI') !!}
        {!! Form::text('dni', $author->dni, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', $author->email, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('birth_date', 'Fecha de nacimiento:') !!}
        {!! Form::date('birth_date', $author->birth_date, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('notas', 'Notas:') !!}
        {!! Form::textarea('notas', $author->notas, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}