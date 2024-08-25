<?php

namespace App\Http\Requests\Tour\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\File;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Убедитесь, что это значение соответствует вашей логике авторизации
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'image' => [
                'required',
                File::types(['png', 'jpg', 'jpeg', 'gif'])
                    ->max(12 * 1024), // 12 MB
            ],
            'price' => 'required|numeric|min:0',
            'how_many_peoples' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'departing' => 'required|date',
            'finishing' => 'required|date|after_or_equal:departing',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();

        // Создание ответа с ошибками в формате HTML
        $response = Response::view('errors.validation', [
            'errors' => $errors
        ], 422); // Код состояния 422 для ошибок валидации

        throw new HttpResponseException($response);
    }
}
