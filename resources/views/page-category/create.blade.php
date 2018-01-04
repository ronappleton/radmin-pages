@extends('radmin::layouts.master')

@section('content')
    {!! Form::open(['route' => 'page-category.store']) !!}
    @include('radmin-pages::page-category.form')
    <div class="form-group">
        {{ Form::submit('Create Category', ['class' => 'btn btn-sm btn-success form-control']) }}
    </div>

    {{ Form::close() }}
    @endsection