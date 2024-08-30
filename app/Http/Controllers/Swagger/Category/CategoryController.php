<?php

namespace App\Http\Controllers\Swagger\Category;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/categories",
 *     summary="Show all Categories",
 *     tags={"Categories"},
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
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="array",
 *                 @OA\Items(type="object",
 *                     @OA\Property(property="title", type="string", example="Зимние туры"),
 *                     @OA\Property(property="slug", type="string", example="1-winter-tours"),
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Group Tour Not Found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=404),
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="error", type="string", example="not_found."),
 *             @OA\Property(property="message", type="string", example="Not found."),
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *       path="/api/v1/categories/{category}",
 *       summary="Show Categories",
 *       tags={"Categories"},
 *
 *       @OA\Parameter(
 *           name="category",
 *           in="path",
 *           required=true,
 *           description="ID travelDestination",
 *           example=1
 *       ),
 *
 *       @OA\Parameter(
 *          name="Accept-Language",
 *          in="header",
 *          required=true,
 *          @OA\Schema(
 *              type="string",
 *              example="en",
 *              enum={"en", "ru", "kg", "kz", "tj", "tm", "uz"}
 *          ),
 *          description="Language preference for the response. Default is 'en'. Possible values: 'en', 'ru', 'kg', 'kz', 'tj', 'tm', 'uz'."
 *      ),
 *
 *       @OA\Response(
 *           response=200,
 *           description="Ok",
 *           @OA\JsonContent(
 *               @OA\Property(property="status", type="integer", example=200),
 *               @OA\Property(property="success", type="boolean", example=true),
 *               @OA\Property(property="data", type="object",
 *                      @OA\Property(property="title", type="string", example="Зимние туры"),
 *                      @OA\Property(property="slug", type="string", example="1-winter-tours"),
 *               )
 *           )
 *       ),
 *       @OA\Response(
 *            response=404,
 *            description="Group Tour Not Found",
 *            @OA\JsonContent(
 *                @OA\Property(property="status", type="integer", example=404),
 *                @OA\Property(property="success", type="boolean", example=false),
 *                @OA\Property(property="error", type="string", example="not_found"),
 *                @OA\Property(property="message", type="string", example="Not found."),
 *            )
 *       )
 *  )
 */
class CategoryController extends Controller
{

}
