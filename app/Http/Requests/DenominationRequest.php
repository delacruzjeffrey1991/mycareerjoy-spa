<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DenominationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'voucher_id' => 'required',
            'voucher_gateway_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'voucher_value' => 'required',
            'selling_price' => 'required',
            'allow_swipe' => 'required',
            'swipe_terms_content' => 'required',
            'swipe_mechanics_content' => 'required',
            'status' => 'required',
        ];
    }
}
