<?php

namespace App\Http\Requests\Tour\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Redirect;
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
            'category_id' => 'required|integer|exists:categories,id',
            'travel_destination_id' => 'required|integer|exists:travel_destinations,id',
            'image' => [
                'required',
                File::types(['png', 'jpg', 'jpeg'])
                    ->max(12 * 1024),
            ],
            'images.*' => [
                'required',
                File::types(['png', 'jpg', 'jpeg'])
                    ->max(12 * 1024),
            ],
            'price' => 'required|numeric|min:0',
            'how_many_peoples' => 'required|integer|min:1',
            'description' => 'required',
            'inclusions' => 'required',
            'exclusions' => 'required',
            'departing' => 'required|date_format:Y-m-d',
            'finishing' => 'required|date_format:Y-m-d|after_or_equal:departing',
            'status' => 'required|in:available,unavailable,pending',


            'days' => 'required|array|min:1', // 'days' должен быть массивом и содержать минимум один элемент
            'days.*.title' => 'required|string|max:255', // Заголовок для каждого дня должен быть строкой и не превышать 255 символов
            'days.*.description' => 'required|string|max:255', // Описание для каждого дня должно быть строкой и не превышать 255 символов

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

        $response = Redirect::route('admin.group_tours.create')
            ->withErrors($errors)
            ->withInput();

        throw new HttpResponseException($response);
    }
}
