<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CatalogAjaxRequest extends FormRequest
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
            'parent_id' => [
                'required',
                Rule::exists('catalog_categories', 'parent_id')
                    ->where(function ($query){
                        $parent_id = $this->input('parent_id');
                        $query->where('cartegory_id', $parent_id);
                    }),
            ],
            'url_part' => [
                'required',
                'regex:[a-zA-Z0-9-]',
            ]
        ];
    }
}
