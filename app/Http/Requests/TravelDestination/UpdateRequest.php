<?php

namespace App\Http\Requests\TravelDestination;

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
            'name' => 'required|string|max:255',
            'destination_id' => 'required|integer|exists:destinations,id',
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

        // Получаем ID тура из маршрута
        $travelDestinationId = $this->route('travelDestination');

        // Формируем ответ с ошибками и перенаправлением на страницу редактирования
        $response = Redirect::route('admin.travel_destinations.edit', ['travelDestination' => $travelDestinationId])
            ->withErrors($errors)
            ->withInput();

        throw new HttpResponseException($response); // Выбрасываем исключение с ответом
    }
}
