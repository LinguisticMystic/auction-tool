<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|integer',
            'bid_amount' => [
                'required',
                'regex:/^\d+([\.\,]\d{1,2})?$/'
            ],
            'auction_item_id' => 'required'
        ];
    }
}
