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
                    'value' => $structure->content,
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
