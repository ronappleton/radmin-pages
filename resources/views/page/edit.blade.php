@extends('radmin::layouts.master')

@section('title', 'Pages')

@section('content')
    <div style="padding-top: 20px;"></div>
    <div class="card">
        <div class="card-header">
            Edit a Page
        </div>
        <div class="card-block">
            <div class="card-text">
                {{ Form::model($model, ['route' => ['page.update', $model], 'method' => 'PUT']) }}
                @include('radmin-pages::page.form')
                <div class="col-12">
                    <div class="form-group">
                        {{ Form::submit('Change User', ['class' => 'btn btn-sm btn-success form-control']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
