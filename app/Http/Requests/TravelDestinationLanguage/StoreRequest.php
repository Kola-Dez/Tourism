<?php

namespace App\Http\Requests\TravelDestinationLanguage;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Redirect;

class StoreRequest extends FormRequest
{
    /**
     * Получить правила валидации, применимые к запросу.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'travel_destination_id' => 'required|integer|exists:travel_destinations,id',
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

        $travelDestinationLanguagesId = $this->route('id');

        $response = Redirect::route('admin.travel_destination_languages.crete', ['id' => $travelDestinationLanguagesId])
            ->withErrors($errors)
            ->withInput();

        throw new HttpResponseException($response);
    }
}
