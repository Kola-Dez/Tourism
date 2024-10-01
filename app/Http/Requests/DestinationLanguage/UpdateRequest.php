<?php

namespace App\Http\Requests\DestinationLanguage;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Redirect;

class UpdateRequest extends FormRequest
{
    /**
     * Получить правила валидации, применимые к запросу.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'destination_id' => 'required|integer|exists:destinations,id',
            'language_id' => 'required|integer|exists:languages,id',
            'translate_name' => 'required|string',
            'translate_description' => 'required|string',
        ];
    }

    /**
     * Обработка неудачной валидации.
     *
     * @param  Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();

        $destinationLanguagesId = $this->route('id');

        $response = Redirect::route('admin.destination_languages.edit', ['id' => $destinationLanguagesId])
            ->withErrors($errors)
            ->withInput();

        throw new HttpResponseException($response);
    }
}
