<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'slug' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'string'
            ],
            'image'=> [
                'nullable',
                // 'mimes:png,jpg',
                // 'mimetypes:image/jpeg,image/png',
            ],

            'category_id' => [
                'required',
                'integer'
            ],

            'sub_category_id' => [
                'required',
                'integer'
            ],
            'brand' => [
                'required',
                'string',
                'max: 255'
            ],
            'small_description' => [
                'required',
                'string'
            ],

            'original_price' => [
                'required',
                'integer'
            ],
            // 'sale_price' => [
            //     'integer',

            // ],
            'quantity' => [
                'required',
                'integer'
            ],
            'trending' => [
                'nullable'
            ],
            'featured' => [
                'nullable'
            ],
            'status' => [
                'nullable'
            ],

            'meta_title' => [
                'nullable',
                'string',
                'max: 255'
            ],
            'meta_keyword' => [
                'nullable',
                'string'
            ],
            'meta_description' => [
                'nullable',
                'string'
            ]
        ];
    }
}
