<?php

namespace App\Http\Controllers\Swagger\TravelDestination;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/travels",
 *     summary="Show all TravelDestination",
 *     tags={"Travel-Destination"},
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
 *                     @OA\Property(property="name", type="string", example="Алатын-Арашан"),
 *                     @OA\Property(property="slug", type="string", example="1-altyn-arashan"),
 *                     @OA\Property(property="image", type="string", example="Test.png"),
 *                     @OA\Property(property="description", type="string", example="Test test hello this is test description"),
 *                     @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                     @OA\Property(property="destination_slug", type="string", example="1-kyrgyzstan"),
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Travel-Destination Not Found",
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
 *       path="/api/v1/travels/{travelDestination}",
 *       summary="Show TravelDestination",
 *       tags={"Travel-Destination"},
 *
 *       @OA\Parameter(
 *           name="travelDestination",
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
 *                     @OA\Property(property="name", type="string", example="Алатын-Арашан"),
 *                      @OA\Property(property="slug", type="string", example="1-altyn-arashan"),
 *                      @OA\Property(property="image", type="string", example="Test.png"),
 *                      @OA\Property(property="description", type="string", example="Test test hello this is test description"),
 *                      @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                      @OA\Property(property="destination_slug", type="string", example="1-kyrgyzstan"),
 *               )
 *           )
 *       ),
 *       @OA\Response(
 *            response=404,
 *            description="Travel-Destination Not Found",
 *            @OA\JsonContent(
 *                @OA\Property(property="status", type="integer", example=404),
 *                @OA\Property(property="success", type="boolean", example=false),
 *                @OA\Property(property="error", type="string", example="not_found"),
 *                @OA\Property(property="message", type="string", example="Not found."),
 *            )
 *       )
 *  )
 */
class TravelDestinationController extends Controller
{

}
