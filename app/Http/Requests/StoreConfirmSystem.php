<?php

namespace App\Http\Requests;

use App\Models\Job;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreConfirmSystem extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'fk_company' => ['required', 'exists:companies,id'],
            'fk_car' => ['required', 'exists:cars,id'],
            'start_car' => 'required|before_or_equal:end_car',
            'end_car' => 'required|after_or_equal:start_car',
            'paid' => 'required|numeric|min:0',
            'start_date' => 'required|date|before_or_equal:today',
            'start[]' => 'before_or_equal:end[]',
            'end[]' => 'after_or_equal:start[]',
            'fk_typetask' => ['required', 'exists:task_type,id'],
            'fk_user' => ['required', 'exists:users,id'],
            'description' => 'required',            
            
        ];
    }
}
