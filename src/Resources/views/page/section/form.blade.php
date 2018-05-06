@include('laravel-building::partial.errors')

<form action="{{ $action }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="pages_id" value="{{ $data['page']->id }}">

    <fieldset class="panel panel-default">
        <div class="panel-body">
            <div class="col-xs-12">
                @if($edit)
                    <h3>Edit section</h3>
                    {{ method_field('PATCH') }}
                @else
                    <h3>Create section</h3>
                @endif
            </div>
            <div class="form-group col-xs-12">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" placeholder="My new section title." value="{{ $edit ? $data['section']->title : old('title') }}">
            </div>

            <div class="form-group col-xs-12">
                <label for="params">Params</label>
                <input class="form-control" type="text" name="params" placeholder="Valid JSON only." value="{{ $edit ? $data['section']->params : old('params') }}">
            </div>

            <div class="form-group col-xs-12">
                <label for="type">Component</label>
                {!! $form->select('components_id', $data['components'], $edit ? $data['section']->components_id : null, ['class'=>'form-control', 'placeholder'=>'Select a component type...']) !!}
            </div>

            <div class="form-group col-xs-12">
                <label for="meta">Order</label>
                <input class="form-control" type="text" name="order" placeholder="Larger numbers take priority." value="{{ $edit ? $data['section']->order : old('order') }}">
            </div>
        </div>

        {{-- Form --}}
        </div>
    </fieldset>

    <div class="row text-center">
        <div class="col-sm-12">
            @include('laravel-building::partial.button-save')
        </div>
    </div>
</form>
