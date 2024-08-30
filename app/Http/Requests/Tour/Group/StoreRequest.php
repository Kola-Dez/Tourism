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
            'category_id' => 'required|integer|exists:categories,id',
            'travel_destination_id' => 'required|integer|exists:travel_destinations,id',
            'image' => [
                'required',
                File::types(['png', 'jpg', 'jpeg', 'gif'])
                    ->max(12 * 1024), // 12 MB
            ],
            'price' => 'required|numeric|min:0',
            'how_many_peoples' => 'required|integer|min:1',
            'description' => 'required',
            'inclusions' => 'required',
            'exclusions' => 'required',
            'departing' => 'required|date_format:Y-m-d',
            'finishing' => 'required|date_format:Y-m-d|after_or_equal:departing',
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

        $response = Response::view('errors.validation', [
            'errors' => $errors
        ], 422);

        throw new HttpResponseException($response);
    }
}
