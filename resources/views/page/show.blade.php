@extends($layout)

@section('title', $model->title)

@section('content')
    <div style="padding-top: 20px;"></div>
    <div class="card">
        <div class="card-header">
            {!! $model->content_header !!}
        </div>
        <div class="card-block">
            <div class="card-text">
                {!! $model->content !!}
            </div>
        </div>
    </div>
@endsection