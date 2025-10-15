<?php

namespace App\Http\Requests;

class SearchRequest extends BaseRequest
{
    
    protected function prepareForValidation()
    {
        $this->merge([
            'affiliateCode' => env('QUERO_PASSAGEM_AFFILIATE_CODE'),
            'include-connections' => false,
        ]);
    }

    public function rules(): array
    {
        return [
            'from' => 'required|string',
            'to' => 'required|string',
            'travelDate' => 'required|date_format:Y-m-d',
            'affiliateCode' => 'sometimes|string',
            'include-connections' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'from.required' => 'O campo origem é obrigatório.',
            'to.required' => 'O campo destino é obrigatório.',
            'travelDate.required' => 'O campo data de viagem é obrigatório.',
            'travelDate.date_format' => 'O campo data de viagem deve estar no formato AAAA-MM-DD.',
        ];
    }
}
