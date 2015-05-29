@extends('app')
@section('content')

    {!! Form::open(array('route' => 'store_project', 'method' => 'POST' )) !!}

    <div class="form-group @if ($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Nome: ') !!}</br>
        {!! Form::text('name') !!}
        @if ($errors->has('name'))
        <span class="alert alert-danger">
            {{ $errors->first('name') }}
        </span>

        @endif
    </div>

    <div>
        {!! Form::label('acronym', 'Acrónimo:') !!}</br>
        {!! Form::text('acronym') !!}
    </div>

    <div class="form-group @if ($errors->has('type')) has-error @endif">
        {!! Form::label('type', 'Tipo:') !!}</br>
        {!! Form::text('type') !!}
        @if ($errors->has('type'))
        <span class="alert alert-danger">
            {{ $errors->first('type') }}
        </span>

        @endif
    </div>

    <div class="form-group @if ($errors->has('description')) has-error @endif">
        {!! Form::label('description', 'Descrição:') !!}</br>
        {!! Form::textarea('description') !!}
        @if ($errors->has('description'))
        <span class="alert alert-danger">
            {{ $errors->first('description') }}
        </span>

        @endif
    </div>

    <div class="form-group @if ($errors->has('theme')) has-error @endif">
        {!! Form::label('theme', 'Área temática:') !!}</br>
        {!! Form::text('theme') !!}
        @if ($errors->has('theme'))
        <span class="alert alert-danger">
            {{ $errors->first('theme') }}
        </span>

        @endif
    </div>

    <div>
        {!! Form::label('keywords', 'Palavras chave:') !!}</br>
        {!! Form::text('keywords') !!}
    </div>

    <div class="form-group @if ($errors->has('started_at')) has-error @endif">
        {!! Form::label('started_at', 'Data de inicio:') !!}</br>
        {!! Form::input('date', 'started_at') !!}
        @if ($errors->has('started_at'))
        <span class="alert alert-danger">
            {{ $errors->first('started_at') }}
        </span>

        @endif
    </div>

    <div class="form-group @if ($errors->has('featured_until')) has-error @endif">
        {!! Form::label('featured_until', 'Desenvolvido até:') !!}</br>
        {!! Form::input('date', 'featured_until') !!}
        @if ($errors->has('featured_until'))
        <span class="alert alert-danger">
            {{ $errors->first('featured_until') }}
        </span>

        @endif
    </div>

    <div>
        {!! Form::label('finished_at', 'Data de finalização:') !!}</br>
        {!! Form::input('date', 'finished_at') !!}
    </div>

    <div class="form-group @if ($errors->has('state')) has-error @endif">
        {!! Form::label('state', 'Estado:') !!}</br>
        {!! Form::select('state', array('default' => 'Seleccione uma opção') + $state, 'default') !!}
        @if ($errors->has('state'))
        <span class="alert alert-danger">
            {{ $errors->first('state') }}
        </span>

        @endif
    </div>

    <p>
        {!! Form::label('used_software', 'Software utilizado:') !!}</br>
        {!! Form::textarea('used_software') !!}
    </p>

    <div>
        {!! Form::label('used_hardware', 'Hardware utilizado:') !!}</br>
        {!! Form::textarea('used_hardware') !!}
    </div>

    <div>
        {!! Form::label('observations', 'Observações:') !!}</br>
        {!! Form::textarea('observations') !!}
    </div>

    <div>
        {!! Form::submit('Adicionar') !!}
    </div>

    {!! Form::close() !!}

@endsection