<?php

namespace App\Http\Requests\Destination;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\File;

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
            'description' => 'nullable',
            'image' => [
                'nullable',
                File::types(['png', 'jpg', 'jpeg'])
                ->max(12 * 1024),
            ],
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

        $destinationId = $this->route('destination');

        // Формируем ответ с ошибками и перенаправлением на страницу редактирования
        $response = Redirect::route('admin.destinations.edit', ['destination' => $destinationId])
            ->withErrors($errors)
            ->withInput();

        throw new HttpResponseException($response); // Выбрасываем исключение с ответом
    }
}
