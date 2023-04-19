<?php

namespace App\Http\Requests;

use App\Company;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCompanyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'kontrahent_kod' => [
                'required',
            ],
            'kontrahent_nazwa1' => [
                'required',
                'min:10',
                'max:255',
            ],
            'kontrahent_nazwa2' => [
                'max:255',
            ],
            'kontrahent_nazwa3' => [
                'max:255',
            ],
            'kontrahent_ulica' => [
                'required',
                'min:5',
                'max:255',
            ],
            'kontrahent_miasto' => [
                'required',
                'min:5',
                'max:255',
            ],
            'kontrahent_kodpocztowy' => [
                'required',
                'regex:/^(?:\d{2}-\d{3})$/i',
            ],
            'kontrahent_poczta' => [
                'required',
                'min:5',
                'max:255',
            ],
            'kontrahent_telefon1' => [
                'required',
                'numeric',              
            ],
            'kontrahent_email' => [
                'required',
                'regex:/(.+)@(.+)\.(.+)/i',
                
            ],
            'kontrahent_odleglosc' => [
                'required',
            ],
            'kontrahent_grupa' => [
                'required',
            ],
            'kontrahent_nip' => [
                'required',
                'min:5',
                'max:14',
                'unique:kontrahenci',
            ],

        ];
    }
}
