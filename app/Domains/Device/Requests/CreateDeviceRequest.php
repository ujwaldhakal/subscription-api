<?php
namespace App\Domains\Device\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeviceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'uID' => 'required|max:255',
            'appID' => 'required|string',
            'os' => 'required|string',
            'language' => 'nullable'
        ];
    }
}
