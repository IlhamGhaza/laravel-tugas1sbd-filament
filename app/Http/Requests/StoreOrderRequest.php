<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_number' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'order_details' => 'required|array',
            'order_details.*.arrangement_id' => 'required|exists:flower_arrangements,arrangement_id',
            'order_details.*.quantity' => 'required|integer|min:1',
            'payment.payment_date' => 'required|date',
            'payment.payment_method' => 'required|string',
            'payment.payment_status' => 'required|string',
        ];
    }
}
