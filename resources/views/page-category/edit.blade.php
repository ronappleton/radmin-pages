@extends('radmin::layouts.master')

@section('content')
    {{ Form::model($model, ['route' => ['page-category.update', $model], 'method' => 'PUT']) }}
    @include('radmin-pages::form')
    <div class="form-group">
        {{ Form::submit('Change User', ['class' => 'btn btn-sm btn-success form-control']) }}
    </div>
    {{ Form::close() }}
@endsection