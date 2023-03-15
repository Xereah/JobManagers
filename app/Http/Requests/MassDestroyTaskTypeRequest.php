<?php

namespace App\Http\Requests;

use App\TaskType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaskTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('TaskType_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:task_type,id',
        ];
    }
}
