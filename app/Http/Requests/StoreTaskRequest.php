<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'task_title'     => [
                'required',
            ],
            'fk_company'     => [
                'required',
            ],
            'fk_user'    => [
                'required',            
            ],
        ];
    }
}
