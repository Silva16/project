<div class="container">
<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Nome: ') !!}</br>
    {!! Form::text('name', null, array('class' => 'form-control')) !!}
    @if ($errors->has('name'))
    <span class="alert alert-danger">
        {{ $errors->first('name') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Email:') !!}</br>
    {!! Form::email('email', null,  array('class' => 'form-control', 'placeholder' => 'contact@example.com')) !!}
    @if ($errors->has('email'))
    <span class="alert alert-danger">
        {{ $errors->first('email') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('alt_email')) has-error @endif">
    {!! Form::label('alt_email', 'Email alternativo:') !!}</br>
    {!! Form::email('alt_email', null, array('class' => 'form-control', 'placeholder' => 'contact@example.com')) !!}
    @if ($errors->has('alt_email'))
    <span class="alert alert-danger">
        {{ $errors->first('alt_email') }}
    </span>

    @endif
</div>



<div class="form-group @if ($errors->has('password')) has-error @endif">
    {!! Form::label('password', 'Password:') !!}</br>
    {!! Form::password('password', array('class' => 'form-control')) !!}
    @if ($errors->has('password'))
    <span class="alert alert-danger">
        {{ $errors->first('password') }}
    </span>

    @endif
</div>

<div>
    {!! Form::label('password_confirmation', 'Confirmação password:') !!}</br>
    {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
</div>

<div class="form-group @if ($errors->has('institution_id')) has-error @endif">
    {!! Form::label('institution_id', 'Instituto:') !!}</br>
    {!! Form::select('institution_id', array('default' => 'Seleccione uma opção') + $institutions, 'default', array('class' => 'form-control')) !!}
    @if ($errors->has('institution_id'))
    <span class="alert alert-danger">
        {{ $errors->first('institution_id') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('position')) has-error @endif">
    {!! Form::label('position', 'Posição: ') !!}</br>
    {!! Form::text('position', null, array('class' => 'form-control', 'placeholder' => 'Estudante, Professor, ...')) !!}
    @if ($errors->has('position'))
    <span class="alert alert-danger">
        {{ $errors->first('position') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('role')) has-error @endif">
    {!! Form::label('role', 'Tipo de utilizador:') !!}</br>
    {!! Form::select('role', array('default' => 'Seleccione uma opção') + $roles, 'default', array('class' => 'form-control')) !!}
    @if ($errors->has('role'))
    <span class="alert alert-danger">
        {{ $errors->first('role') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('status')) has-error @endif">
    {!! Form::label('status', 'Estado da conta:') !!}</br>
    {!! Form::select('status', array('default' => 'Seleccione uma opção') + $status, 'default', array('class' => 'form-control')) !!}
    @if ($errors->has('status'))
    <span class="alert alert-danger">
        {{ $errors->first('status') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('photo_url')) has-error @endif">
    {!! Form::label('photo_url', 'Foto: ') !!}</br>
    {!! Form::file('photo_url', null, array('class' => 'form-control')) !!}
    @if ($errors->has('photo_url'))
    <span class="alert alert-danger">
        {{ $errors->first('photo_url') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('profile_url')) has-error @endif">
    {!! Form::label('profile_url', 'URL: ') !!}</br>
    {!! Form::url('profile_url', null , array('class' => 'form-control', 'placeholder' => 'http://www.example.com')) !!}
    @if ($errors->has('profile_url'))
    <span class="alert alert-danger">
        {{ $errors->first('profile_url') }}
    </span>

    @endif
</div>

<div>
    {!! Form::submit($submitButton) !!}
</div>
</div>