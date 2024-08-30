<?php

namespace App\Http\Controllers\Swagger\Tours;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/group-tours",
 *     summary="Show all Group-Tours",
 *     tags={"Group-Tours"},
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
 *                     @OA\Property(property="travel_destination", type="string", example="Алатын-Арашан"),
 *                     @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                     @OA\Property(property="image", type="string", example="Test.png"),
 *                     @OA\Property(property="date", type="string", example="5D/4N"),
 *                     @OA\Property(property="price", type="integer", example=10000),
 *                     @OA\Property(property="description", type="string", example="Test test hello this is test description"),
 *                     @OA\Property(property="peoples", type="integer", example=10),
 *                     @OA\Property(property="inclusions", type="string", example="this inclusions"),
 *                     @OA\Property(property="exclusions", type="string", example="this exclusions"),
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
 *       path="/api/v1/group-tours/{groupTour}",
 *       summary="Show Group-Tours",
 *       tags={"Group-Tours"},
 *
 *       @OA\Parameter(
 *           name="groupTour",
 *           in="path",
 *           required=true,
 *           description="ID Group-Tours",
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
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="travel_destination", type="string", example="Алатын-Арашан"),
 *                   @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                   @OA\Property(property="image", type="string", example="Test.png"),
 *                   @OA\Property(property="date", type="string", example="5D/4N"),
 *                   @OA\Property(property="price", type="integer", example=10000),
 *                   @OA\Property(property="description", type="string", example="Test test hello this is test description"),
 *                   @OA\Property(property="peoples", type="integer", example=10),
 *                   @OA\Property(property="inclusions", type="string", example="this inclusions"),
 *                   @OA\Property(property="exclusions", type="string", example="this exclusions"),
 *                   @OA\Property(property="itinerary", type="array",
 *                       @OA\Items(type="object",
 *                           @OA\Property(property="day_number", type="integer", example=1),
 *                           @OA\Property(property="title", type="string", example="Day 1: Arrival"),
 *                           @OA\Property(property="description", type="string", example="Arrival and check-in at the hotel.")
 *                       )
 *                   )
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
class GroupTourController extends Controller
{

}
