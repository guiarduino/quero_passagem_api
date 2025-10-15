<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    /**
     * Manipula a resposta de erro de validação.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Invalid request. Please check your input and try again.',
                'errors' => $validator->errors()->all(),   
            ], 400)
        );
    }

    /**
     * Executado após a validação bem-sucedida.
     */
    protected function passedValidation()
    {
        // Você pode executar ações aqui, como limpar dados ou registrar logs.
        // Exemplo:
        // $this->merge(['name' => trim($this->name)]);
    }
}
