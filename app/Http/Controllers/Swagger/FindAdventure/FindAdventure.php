<?php

namespace App\Http\Controllers\Swagger\FindAdventure;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/v1/findAdventures",
 *     summary="Find-adventure",
 *     tags={"Find-Adventure"},
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
 *     @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="month", type="string", example="september"),
 *                      @OA\Property(property="destination", type="integer", example=1),
 *                      @OA\Property(property="category", type="integer", example=1),
 *                  ),
 *              }
 *          ),
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=200),
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="group", type="array",
 *                     @OA\Items(type="object",
 *                          @OA\Property(property="id", type="integer", example=1),
 *                          @OA\Property(property="travel_destination", type="string", example="Алатын-Арашан"),
 *                          @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                          @OA\Property(property="category", type="string", example="Зимние туры"),
 *                          @OA\Property(property="price", type="integer", example=10000),
 *                          @OA\Property(property="title", type="string", example="TestGroupTour"),
 *                          @OA\Property(property="image", type="string", example="Test.png"),
 *                          @OA\Property(property="date", type="string", example="5D/4N")
 *                     )
 *                 ),
 *                 @OA\Property(property="private", type="array",
 *                     @OA\Items(type="object",
 *                          @OA\Property(property="id", type="integer", example=1),
 *                          @OA\Property(property="travel_destination", type="string", example="Алатын-Арашан"),
 *                          @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                          @OA\Property(property="category", type="string", example="Зимние туры"),
 *                          @OA\Property(property="title", type="string", example="TestPrivateTour"),
 *                          @OA\Property(property="image", type="string", example="Test.png"),
 *                          @OA\Property(property="date", type="string", example="5D/4N")
 *                     )
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
class FindAdventure extends Controller
{

}
