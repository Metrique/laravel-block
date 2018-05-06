<form action="{{ $action }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="type" value="{{ $data['section']->component->single_item ? 'single' : 'multi' }}">

    <fieldset class="panel panel-default">
        <div class="panel-body">
            <div class="col-xs-12">
                @if($edit)
                    <h3>Edit content</h3>
                    {{ method_field('PATCH') }}
                @else
                    <h3>Create content</h3>
                @endif
            </div>

            {{-- Create form --}}
            @if(!$edit)
                @foreach($data['section']->component->structure as $structure)
                    <div class="form-group col-xs-12">
                        {!!
                            $content->input([
                                'classes' => ['form-control'],
                                'type' => $structure->type->slug,
                                'name' => $content->inputName([
                                    'structure_id' => $structure->id
                                ]),
                                'label' => $structure->title,
                            ]);
                        !!}
                    </div>
                @endforeach

                <div class="form-group col-xs-12">
                    <input type="checkbox" id="published-0" name="published[]" value="0">
                    <label for="published-0">Publish</label>
                </div>
            @endif

            {{-- Edit form --}}
            @if($edit)
                @foreach($data['content'] as $groupId => $group)
                    @foreach($data['section']->component->structure as $structure)
                        <div class="form-group col-xs-12">
                            {!!
                                $content->input([
                                    'classes' => ['form-control'],
                                    'type' => $structure->type->slug,
                                    'name' => $content->inputName([
                                        'structure_id' => $structure->id,
                                        'group_id' => $groupId,
                                        'content_id' => $content->fromGroupByStructure($group, $structure->id)->id,
                                    ]),
                                    'label' => $structure->title,
                                    'value' => $content->fromGroupByStructure($group, $structure->id)->content,
                                ]);
                            !!}
                        </div>
                    @endforeach

                    <div class="form-group col-xs-12">
                        <input type="checkbox" id="published-{{ $groupId }}" name="published[]" value="{{ $groupId }}" {{ $group->first()->published == 1 ? 'checked' : '' }}>
                        <label for="published-{{ $groupId }}">Publish</label>
                    </div>
                @endforeach
            @endif

        </div>
    </fieldset>

    <div class="row text-center">
        <div class="col-sm-12">
            @include('laravel-building::partial.button-save')
        </div>
    </div>
</form>
