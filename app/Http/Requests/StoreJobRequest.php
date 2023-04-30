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

    public function messages()
    {
    return [
        'description[].required' => 'Pole Opis jest wymagane',
        'fk_user.required' => 'Pole Odpowiedzialny jest wymagane',
        'fk_typetask.required' => 'Pole Nazwa Zadania jest wymagane',
        'start[].required' => 'Pole Początek jest wymagane',
        'end[].required' => 'Pole Koniec jest wymagane',
        'end[].after_or_equal' => 'Koniec nie może być wcześniejszy niż koniec',
        'start[].before_or_equal' => 'Początek nie może być późniejszy niż koniec',
        'start_date[].required' => 'Pole Data Początkowa jest wymagane',
        'start_date[].before_or_equal' => 'Nie wpisujemy daty z przyszłości :D',
        'end_date[].required' => 'Pole Data Początkowa jest wymagane',
        'end_date[].before_or_equal' => 'Nie wpisujemy daty z przyszłości :D',
        'end_date[].after_or_equal' =>'Data końcowa nie może być wcześniejsza niż początkowa',
        'fk_company.required' => 'Pole Firma jest wymagane',

        'fk_typetask_new[].required' => 'Pole Nazwa Zadania jest wymagane',
        'start_date_new[].required' => 'Pole Data Początkowa jest wymagane',
        'start_date_new[].before_or_equal' => 'Nie wpisujemy daty z przyszłości :D',
        'end_date_new[].required' => 'Pole Data Początkowa jest wymagane',
        'end_date_new[].before_or_equal' => 'Nie wpisujemy daty z przyszłości :D',
        'end_date_new[].after_or_equal' =>'Data końcowa nie może być wcześniejsza niż początkowa',
        'start_new[].required' => 'Pole Początek jest wymagane',
        'end_new[].required' => 'Pole Koniec jest wymagane',
        'end_new[].after_or_equal' => 'Koniec nie może być wcześniejszy niż koniec',
        'start_new[].before_or_equal' => 'Początek nie może być późniejszy niż koniec',
        'description_new[].required' => 'Pole Opis jest wymagane',

    ];
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
                'after_or_equal:start_date_new[]'           
               
            ],
            'start_new[]' => [
                'required',
                
            ],
            'end_new[]' => [
                'required',
                'after_or_equal:start_new[]'
                
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
