<?php

namespace App\Http\Requests\Blog;

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
            'title' => 'required|string|max:255',
            'destination_id' => 'required|integer|exists:destinations,id',
            'image' => [
                'nullable',
                File::types(['png', 'jpg', 'jpeg'])
                    ->max(12 * 1024),
            ],
            'description' => 'required|string',
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
        $blogId = $this->route('blog');

        // Формируем ответ с ошибками и перенаправлением на страницу редактирования
        $response = Redirect::route('admin.blogs.edit', ['blog' => $blogId])
            ->withErrors($errors)
            ->withInput();

        throw new HttpResponseException($response); // Выбрасываем исключение с ответом
    }
}
