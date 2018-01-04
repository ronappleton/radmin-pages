<div class="input-group {{ $errors->has('category') ? 'has-error' : '' }}">
    <i class="material-icons">face</i>
    {{ Form::text('category', old('category'), ['class' => 'form-control', 'placeholder' => 'Category Name...']) }}
    @if ($errors->has('category'))
        <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
    @endif
</div>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">