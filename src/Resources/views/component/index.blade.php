@extends('laravel-building::main')

@section('content')
    @include('laravel-building::partial.header', [
        'heading'=>'Components',
        'link'=>route($routes['create']),
        'title'=>'New component.',
        'icon'=>'fa-plus'
    ])

    <div class="row">
        <div class="col-xs-12">
        @if(count($data['components']) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Single item</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['components'] as $key=>$value)
                    <tr>
                        <td>
                            <a href="{{ route($routes['edit'], $value->id) }}">{{ $value->title }}</a>
                        </td>
                        <td>{{ $value->slug }}</td>
                        <td>
                            <i class="fa fa-lg fa-{{ $value->single_item ? 'check' : 'times' }}"></i>
                        </td>
                        <td class="text-right">
                            <a href="{{ route($routes['structure.index'], $value->id) }}" class="btn btn-default">
                                <i class="fa fa-pencil"></i> Edit structure
                            </a>
                        </td>
                        <td class="text-right">
                            @include('laravel-building::partial.button-destroy', [
                                'route'=>route($routes['destroy'], $value->id),
                            ])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No components exist.</p>
        @endif
        </div>
    </div>
@endsection
