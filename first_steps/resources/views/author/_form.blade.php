<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('apellidos', 'Apellidos:') !!}
    {!! Form::text('apellidos', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('dni', 'DNI') !!}
    {!! Form::text('dni', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('birth_date', 'Fecha de nacimiento:') !!}
    {!! Form::date('birth_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('notas', 'Notas:') !!}
    {!! Form::textarea('notas', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}