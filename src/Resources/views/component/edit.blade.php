@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Components',
    ])
    @include('laravel-building::component.form', [
        'action' => route($routes['update'], $data['component']->id),
        'edit' => true,
    ])
@endsection
