<?php

namespace App\Http\Requests\CategoryLanguage;

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
            'category_id' => 'required|integer|exists:categories,id',
            'language_id' => 'required|integer|exists:languages,id',
            'translate_title' => 'required|string',
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

        $categoryLanguagesId = $this->route('id');

        $response = Redirect::route('admin.category_languages.crete', ['id' => $categoryLanguagesId])
            ->withErrors($errors)
            ->withInput();

        throw new HttpResponseException($response);
    }
}
