<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutFormRequest extends FormRequest
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
                'string'
            ],
            'email' => [
                'required',
                'string',
                'unique:users'
            ],
            'phone' => [
                'required',
                'string',
                'unique:users'
            ],
            'address' => [
                'required',
                'string'
            ],
            'city' => [
                'required',
                'string'
            ],
            'province' => [
                'required',
                'string'
            ],
            'district' => [
                'required',
                'string'
            ],
            'message' => [
                'nullable',
                'string'
            ],
            // 'total_price' => [
            //     'required',
            //     'integer'
            // ],
            // 'status',
            // 'tracking_no',
        ];
    }
}
