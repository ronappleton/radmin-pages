@extends('radmin::layouts.master')

@section('title', 'Pages')

@section('content')
    <div style="padding-top: 20px;"></div>
    <div class="card">
        <div class="card-header">
            Create a New Page Category
        </div>
        <div class="card-block">
            <div class="card-text">
                {!! Form::open(['route' => 'page-category.store']) !!}
                @include('radmin-pages::page-category.form')
                <div class="col-12">
                    <div class="form-group">
                        {{ Form::submit('Create Category', ['class' => 'btn btn-sm btn-success form-control']) }}
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection