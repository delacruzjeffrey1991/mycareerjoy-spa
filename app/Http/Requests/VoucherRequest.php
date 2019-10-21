<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
            'program_id' => 'required',
            'voucher_gateway_id' => 'required',
            'name' => 'required',
            'product_code' => 'required',
            'type_id' => 'required',
            'branch_list' => 'required',
            'mechanics' => 'required',
            'status' => 'required',
        ];
    }
}
