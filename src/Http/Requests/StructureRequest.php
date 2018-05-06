<?php

namespace Metrique\Building\Http\Requests;

use Metrique\Building\Http\Requests\Request;

class StructureRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'order' => 'integer',
            'components_id' => 'required|exists:components,id',
            'component_types_id' => 'required|exists:component_types,id',
        ];
    }
}
