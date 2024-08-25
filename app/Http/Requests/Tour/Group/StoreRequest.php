<?php

namespace App\Http\Requests\Tour\Group;


use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\File;

class StoreRequest extends FormRequest
{
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
                    ->max(12 * 1024),
            ],
            'price' => 'required|numeric|min:0',
            'how_many_peoples' => 'required|integer|min:1',
            'hits' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'departing' => 'required|date',
            'finishing' => 'required|date|after_or_equal:departing',
            'isPrivate' => 'required',
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();

        $response = Response::json(
            [
            'status' => 400,
            'success' => false,
            'message' => 'validation_failed',
                'data' => $errors
            ], 400);


        throw new HttpResponseException($response);
    }
}
