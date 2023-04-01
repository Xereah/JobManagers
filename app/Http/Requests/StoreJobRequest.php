<?php

namespace App\Http\Requests;

use App\Job;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreJobRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'fk_company' => [
                'required',
                'numeric',
            ],
            'location' => [
                'required',
                'numeric',
            ],
            'fk_tasktype' => [
                'required',
                'numeric',
            ],
            'paid' => [
                'required',
            ],
            'fk_user' => [
                'required',
                'numeric',
            ],
            'rns' => [
                'numeric',
                'min:0',
            ],
            'start_date[]' => [
                'required',
                'date',
                'before_or_equal:now'
            ],
            'end_date[]' => [
                'required',
                'date',
                'before_or_equal:now',
                'after_or_equal:start_date[]'           
               
            ],
            'start[]' => [
                'required',
                
            ],
            'end[]' => [
                'required',
                'after_or_equal:start[]'
                
            ],
            'fk_typetask[]' => [
                'required',
                
            ],
            'description[]' => [
                'required',
                
            ],
            'value[]' => [
                'numeric',
            ],
            
        ];
    }
}
