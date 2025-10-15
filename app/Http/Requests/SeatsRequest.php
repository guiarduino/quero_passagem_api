<?php

namespace App\Http\Requests;

class SeatsRequest extends BaseRequest
{

    public function prepareForValidation()
    {
        $this->merge([
            'orientation' => 'horizontal',
            'type' => 'matrix',
        ]);
    }

    public function rules(): array
    {
        return [
            'travelId' => 'required|string',
            'orientation' => 'sometimes|in:horizontal,vertical',
            'type' => 'sometimes|in:matrix,list',
        ];
    }

    public function messages()
    {
        return [
            'travelId.required' => 'O campo travelId é obrigatório.',
            'travelId.string' => 'O campo travelId deve ser uma string.',
            'orientation.in' => 'O campo orientation deve ser "horizontal" ou "vertical".',
            'type.in' => 'O campo type deve ser "matrix" ou "list".',
        ];
    }
}
