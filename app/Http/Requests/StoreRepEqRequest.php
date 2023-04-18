<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRepEqRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'eq_number'     => [
                'required',
            ],
            'eq_name'     => [
                'required',
            ],
            'serial_number'    => [
                'required',            
            ],
            'entry_date' => [
                'required',
             
            ],
            'comments'  => [
                'integer',
            ],
            'company_place'  => [
                'integer',
            ],
            'eq_category'  => [
                'integer',
                'required',
            ],
        ];
    }
}
