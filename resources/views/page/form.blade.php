<div class="col-12">
    <div style="padding-top: 20px;"></div>
    <div class="form-group">
        <div class="input-group {{ $errors->has('title') ? 'has-error' : '' }}">
            {{ Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'Page Title (Viewable in tab handle)...']) }}
            @if ($errors->has('title'))
                <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
            @endif
        </div>
    </div>


    <div class="form-group">
        <div class="input-group {{ $errors->has('category') ? 'has-error' : '' }}">
            {{ Form::select('category', $categories, null, ['class' => 'form-control', 'placeholder' => 'Category Name...']) }}
            @if ($errors->has('category'))
                <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="input-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Page Name...']) }}
            @if ($errors->has('name'))
                <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="input-group {{ $errors->has('content_header') ? 'has-error' : '' }}">
            {{ Form::text('content_header', old('content_header'), ['class' => 'form-control', 'placeholder' => 'Content Header...']) }}
            @if ($errors->has('content_header'))
                <span class="help-block">
                            <strong>{{ $errors->first('content_header') }}</strong>
                        </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="input-group {{ $errors->has('content') ? 'has-error' : '' }}">
            <textarea class="form-control" name="content" placeholder="Page Content...">{!! old('content') !!}</textarea>
            @if ($errors->has('content'))
                <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
            @endif
        </div>
    </div>
</div>


@push('scripts')
    <script src="{{asset('vendor/tinymce/jquery.tinymce.min.js')}}"></script>
    <script src="{{asset('vendor/tinymce/tinymce.min.js')}}"></script>
    {!! TinyMce::isFor('page')  !!}
@endpush