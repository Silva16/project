<div class="container">
<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Nome: ') !!}</br>
    {!! Form::text('name') !!}
    @if ($errors->has('name'))
    <span class="alert alert-danger">
        {{ $errors->first('name') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Email:') !!}</br>
    {!! Form::email('email') !!}
    @if ($errors->has('email'))
    <span class="alert alert-danger">
        {{ $errors->first('email') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('alt_email')) has-error @endif">
    {!! Form::label('alt_email', 'Email alternativo:') !!}</br>
    {!! Form::email('alt_email') !!}
    @if ($errors->has('alt_email'))
    <span class="alert alert-danger">
        {{ $errors->first('alt_email') }}
    </span>

    @endif
</div>



<div class="form-group @if ($errors->has('password')) has-error @endif">
    {!! Form::label('password', 'Password:') !!}</br>
    {!! Form::password('password') !!}
    @if ($errors->has('password'))
    <span class="alert alert-danger">
        {{ $errors->first('password') }}
    </span>

    @endif
</div>

<div>
    {!! Form::label('password_confirmation', 'Confirmação password:') !!}</br>
    {!! Form::password('password_confirmation') !!}
</div>

<div class="form-group @if ($errors->has('institution_id')) has-error @endif">
    {!! Form::label('institution_id', 'Instituto:') !!}</br>
    {!! Form::select('id', $institutions, null) !!}
    @if ($errors->has('institution_id'))
    <span class="alert alert-danger">
        {{ $errors->first('institution_id') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('position')) has-error @endif">
    {!! Form::label('position', 'Posição: ') !!}</br>
    {!! Form::text('position') !!}
    @if ($errors->has('position'))
    <span class="alert alert-danger">
        {{ $errors->first('position') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('flags')) has-error @endif">
    {!! Form::label('flags', 'Flags: ') !!}</br>
    {!! Form::text('flags') !!}
    @if ($errors->has('flags'))
    <span class="alert alert-danger">
        {{ $errors->first('flags') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('role')) has-error @endif">
    {!! Form::label('role', 'Função do utilizador: ') !!}</br>
    {!! Form::text('role') !!}
    @if ($errors->has('role'))
    <span class="alert alert-danger">
        {{ $errors->first('role') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('photo_url')) has-error @endif">
    {!! Form::label('photo_url', 'Foto: ') !!}</br>
    {!! Form::text('photo_url') !!}
    @if ($errors->has('photo_url'))
    <span class="alert alert-danger">
        {{ $errors->first('photo_url') }}
    </span>

    @endif
</div>

<div class="form-group @if ($errors->has('profile_url')) has-error @endif">
    {!! Form::label('profile_url', 'Foto de Perfil: ') !!}</br>
    {!! Form::text('profile_url') !!}
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