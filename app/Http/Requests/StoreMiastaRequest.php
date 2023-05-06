<?php

namespace App\Http\Requests;

use App\Models\Miasta;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreMiastaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'kontrahent_miasto' => [
                'required',
                'max:50',
            ],
            'kontrahent_kodpocztowy' => [
                'required',
                'regex:/^(?:\d{2}-\d{3})$/i',
            ],
            'kontrahent_odleglosc' => [
                'required',
                'min:0',
                'integer'
            ],
        ];
    }
}
