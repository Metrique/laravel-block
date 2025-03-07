<?php

namespace Metrique\Building\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Metrique\Building\Rules\ComponentIsBoundRule;
use Metrique\Building\Services\BuildingServiceInterface;
use ReflectionClass;

class ComponentEditRequest extends FormRequest
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
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->redirect = url()->previous().'#'.$this->request->get('_id');

        return $this->fetchRules(
            $this->request->get(
                '_parent',
                $this->request->get('_id')
            )
        );
    }

    public function prepareForValidation()
    {
        abort_unless(
            (new ComponentIsBoundRule)->passes(
                null,
                $this->request->get('_component')
            ),
            403
        );

        $this->merge(
            collect($this->request)->mapWithKeys(function ($value, $key) {
                return [
                    str_replace('_'.$this->_id, '', $key) => $value,
                ];
            })->toArray()
        );
    }

    private function fetchRules($componentId)
    {
        $component = resolve(BuildingServiceInterface::class)
            ->readComponentOnPage(
                $componentId,
                $this->page
            );

        $rules = collect($component->rules())->map(function ($field) {
            return collect($field)->map(
                function ($rule) {
                    $instantiable = rescue(fn ($rule) => (new ReflectionClass($rule))->isInstantiable(), fn () => false);
                    $instantiable ? new $rule : $rule;
                }
            )->toArray();
        });

        if ($this->request->get('_type', '') == 'attributes') {
            return $rules->intersectByKeys(
                $component->attributes()
            )->toArray();
        }

        if ($this->request->get('_type', '') == 'multiple') {
            return $rules->intersectByKeys(
                collect(
                    $component->properties()
                )->merge(
                    $component->attributes()
                )
            )->toArray();
        }

        if ($this->request->get('_type', '') == 'properties') {
            return $rules->intersectByKeys(
                $component->properties()
            )->toArray();
        }
    }
}
