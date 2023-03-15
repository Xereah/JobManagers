<?php

namespace App\Http\Requests;

use App\Company;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'shortcode' => [
                'required',
            ],
            'name' => [
                'required',
                'min:10',
                'max:255',
            ],
            'street' => [
                'required',
                'min:5',
                'max:255',
            ],
            'zipcode' => [
                'required',
                'regex:/^(?:\d{2}-\d{3})$/i',
            ],
            'location' => [
                'required',
            ],
            'phonenumber' => [
                'required',
                'numeric',
                
            ],
            'email' => [
                'required',
                'regex:/(.+)@(.+)\.(.+)/i',
            ],

        ];
    }
}
