<?php

namespace App\Http\Controllers\Swagger\Gallery;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/galleries",
 *     summary="Show all Gallery",
 *     tags={"Gallery"},
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
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="image", type="string", example="test.png"),
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Gallery Not Found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=404),
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="error", type="string", example="not_found."),
 *             @OA\Property(property="message", type="string", example="Not found."),
 *         )
 *     )
 * ),
 */
class GalleryController extends Controller
{

}
