<?php

namespace App\Http\Controllers\Swagger\Blog;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/blogs",
 *     summary="Show all Blogs",
 *     tags={"Blogs"},
 *
 *     @OA\Parameter(
 *         name="Accept-Language",
 *         in="header",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="en",
 *             enum={"en", "ru", "kg", "kz", "tj", "tm", "uz"}
 *         ),
 *         description="Language preference for the response. Default is 'en'. Possible values: 'en', 'ru', 'kg', 'kz', 'tj', 'tm', 'uz'."
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Successful retrieval of blogs",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="title", type="string", example="title 1 for 1"),
 *                     @OA\Property(property="image", type="string", example="test.png"),
 *                     @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                     @OA\Property(property="description", type="string", example="test description 1 for 1"),
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No blogs found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=404),
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="error", type="string", example="not_found"),
 *             @OA\Property(property="message", type="string", example="No blogs found."),
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/v1/blogs/{blog}",
 *     summary="Show a specific Blog",
 *     tags={"Blogs"},
 *
 *     @OA\Parameter(
 *         name="blog",
 *         in="path",
 *         required=true,
 *         description="ID of the blog to retrieve",
 *         example=1
 *     ),
 *
 *     @OA\Parameter(
 *         name="Accept-Language",
 *         in="header",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="en",
 *             enum={"en", "ru", "kg", "kz", "tj", "tm", "uz"}
 *         ),
 *         description="Language preference for the response. Default is 'en'. Possible values: 'en', 'ru', 'kg', 'kz', 'tj', 'tm', 'uz'."
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Successful retrieval of the blog",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="title 1 for 1"),
 *                 @OA\Property(property="image", type="string", example="test.png"),
 *                 @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                 @OA\Property(property="description", type="string", example="test description 1 for 1"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Blog not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=404),
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="error", type="string", example="not_found"),
 *             @OA\Property(property="message", type="string", example="Blog not found."),
 *         )
 *     )
 * )
 */
class BlogController extends Controller
{
    // Контроллерные методы будут добавлены здесь
}
