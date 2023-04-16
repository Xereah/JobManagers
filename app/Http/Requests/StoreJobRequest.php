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
                'integer',
                'numeric',
            ],
            'location' => [
                'required',
                'numeric',
                'integer',
            ],
            'fk_user' => [
                'required',
                'numeric',
                'integer',
            ],
            'fk_tasktype' => [
                'required',
                'numeric',
                'integer',
            ],
            'paid' => [
                'required',
                'integer',
            ],
            'rns' => [
                'numeric',
                'integer',
                'regex:/^[0-9]+$/',
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
                'integer',
                
            ],
            'description[]' => [
                'required',
                'min:1',
                'max:255',
                
            ],




            'fk_tasktype_new[]' => [
                'required',
                'numeric',
                'integer',
            ],
            'paid_new[]' => [
                'required',
                'integer',
            ],
            'rns_new[]' => [
                'numeric',
                'integer',
                'regex:/^[0-9]+$/',
                'min:0',
            ],
            'start_date_new[]' => [
                'required',
                'date',
                'before_or_equal:now'
            ],
            'end_date_new[]' => [
                'required',
                'date',
                'before_or_equal:now',
                'after_or_equal:start_date[]'           
               
            ],
            'start_new[]' => [
                'required',
                
            ],
            'end_new[]' => [
                'required',
                'after_or_equal:start[]'
                
            ],
            'fk_typetask_new[]' => [
                'required',
                'integer',
                
            ],
            'description_new[]' => [
                'required',
                'min:1',
                'max:255',
                
            ],
            
        ];
    }
}
