@extends('metrique-building::main')

@section('content')
    @include('metrique-building::partial.header', [
        'heading'=>'Page contents',
    ])

    @include($views['form'], [
        'action' => route($routes['store'], [$data['section']->page->id, $data['section']->id]),
        'edit' => false,
        'data' => $data
    ])
@endsection
