<?php
namespace App\Domains\Subscription\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionPurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'token' => 'required',
            'os' => 'required'
        ];
    }
}
