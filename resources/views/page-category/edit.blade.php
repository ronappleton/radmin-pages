@extends('radmin::layouts.master')

@section('title', 'Pages')

@section('content')
    <div style="padding-top: 20px;"></div>
    <div class="card">
        <div class="card-header">
            Eidt Page Category
        </div>
        <div class="card-block">
            <div class="card-text">
                {{ Form::model($model, ['route' => ['page-category.update', $model], 'method' => 'PUT']) }}
                @include('radmin-pages::page-category.form')
                <div class="col-12">
                    <div class="form-group">
                        {{ Form::submit('Change Category', ['class' => 'btn btn-sm btn-success form-control']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection