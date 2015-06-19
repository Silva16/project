<div class="container">
    <div class="form-group @if ($errors->has('title')) has-error @endif">
      {!! Form::label('title', 'Titulo: ') !!}</br>
      {!! Form::text('title', null, array('class' => 'form-control')) !!}
      @if ($errors->has('title'))
          <span class="alert alert-danger">
              {{ $errors->first('title') }}
          </span>
      @endif
    </div>

    <div class="form-group @if ($errors->has('alt')) has-error @endif">
         {!! Form::label('alt', 'Titulo alternativo:') !!}</br>
         {!! Form::text('alt', null, array('class' => 'form-control')) !!}
         @if ($errors->has('alt'))
             <span class="alert alert-danger">
                 {{ $errors->first('alt') }}
             </span>
         @endif
    </div>

    <div class="form-group @if ($errors->has('description')) has-error @endif">
         {!! Form::label('description', 'Descrição:') !!}</br>
         {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
         @if ($errors->has('description'))
             <span class="alert alert-danger">
                 {{ $errors->first('description') }}
             </span>
         @endif
    </div>

    <div class="form-group @if ($errors->has('ext_url')) has-error @endif">
         {!! Form::label('ext_url', 'Referência Externa:') !!}</br>
         {!! Form::url('ext_url', null, array('class' => 'form-control')) !!}
         @if ($errors->has('ext_url'))
             <span class="alert alert-danger">
                 {{ $errors->first('ext_url') }}
             </span>
         @endif
    </div>

    <div class="form-group @if ($errors->has('int_file')) has-error @endif">
        {!! Form::label('int_file', 'Ficheiro: ') !!}</br>
        {!! Form::file('int_file') !!}
        @if ($errors->has('int_file'))
            <span class="alert alert-danger">
                {{ $errors->first('int_file') }}
            </span>
        @endif
    </div>
    <div class="form-group">
        {!! Form::submit($submitButton) !!}
    </div>
</div>