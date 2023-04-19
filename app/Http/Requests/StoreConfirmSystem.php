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
    public function messages()
    {
    return [
        'description.required' => 'Pole Opis jest wymagane',
        'fk_user.required' => 'Pole Odpowiedzialny jest wymagane',
        'fk_typetask.required' => 'Pole Nazwa Zadania jest wymagane',
        'start[].required' => 'Pole Początek jest wymagane',
        'end[].required' => 'Pole Koniec jest wymagane',
        'end[].after_or_equal' => 'Koniec nie może być wcześniejszy niż koniec',
        'start[].before_or_equal' => 'Początek nie może być późniejszy niż koniec',
        'start_date.required' => 'Pole Data Usługi jest wymagane',
        'start_car.required' => 'Pole Wyjazd jest wymagane',
        'start_car.before_or_equal' => 'Godzina wyjazdu nie może być późniejsza niż przyjazdu',
        'end_car.required' => 'Pole Przyjazd jest wymagane',
        'end_car.after_or_equal' => 'Godzina przyjazdu nie może być wcześniejsza niż wyjazdu',
        'fk_car.required' => 'Pole Samochód jest wymagane',
        'fk_company.required' => 'Pole Firma jest wymagane',

    ];
    }
    public function rules()
    {
        return [
            'fk_company' => ['required', 'exists:kontrahenci,id'],
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
            
            
            
            // 'value_goods.*'   => 'required',   
            // 'paid_goods.*'   => 'required',  
            // 'fk_rep_eq.*'   => 'required',  
            // 'paid_eq.*'   => 'required',  
            // 'description_eq.*'   => 'required',  
            
        ];
    }
}
