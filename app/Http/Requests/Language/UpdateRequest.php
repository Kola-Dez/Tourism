<?php

namespace App\Http\Requests\Language;

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
            'name' => 'required|string',
            'code' => 'required|string'
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

        $languageId = $this->route('language');

        // Формируем ответ с ошибками и перенаправлением на страницу редактирования
        $response = Redirect::route('admin.languages.edit', ['language' => $languageId])
            ->withErrors($errors)
            ->withInput();

        throw new HttpResponseException($response);
    }
}
