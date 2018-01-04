@extends('radmin::layouts.master')

@section('content')
    {!! Form::open(['route' => 'page.store']) !!}
    @include('radmin-pages::page.form')
    <div class="form-group">
        {{ Form::submit('Create User', ['class' => 'btn btn-sm btn-success form-control']) }}
    </div>

    {{ Form::close() }}
    @endsection