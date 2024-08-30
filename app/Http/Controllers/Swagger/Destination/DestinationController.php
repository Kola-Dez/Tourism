<?php

namespace App\Http\Controllers\Swagger\Destination;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/v1/destinations",
 *     summary="Show all destinations",
 *     tags={"Destinations"},
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
 *                     @OA\Property(property="slug", type="string", example="1-kyrgyzstan"),
 *                     @OA\Property(property="name", type="string", example="Кыргызстан"),
 *                     @OA\Property(property="image", type="string", example="Test.png"),
 *                     @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=404),
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="error", type="string", example="not_found."),
 *             @OA\Property(property="message", type="string", example="Not found.")
 *         )
 *     )
 * ),
 *
 * @OA\Get(
 *       path="/api/v1/destinations/{destinations}",
 *       summary="Show Destinations",
 *       tags={"Destinations"},
 *
 *       @OA\Parameter(
 *           name="destinations",
 *           in="path",
 *           required=true,
 *           description="ID Destinations",
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
 *                     @OA\Property(property="slug", type="string", example="1-kyrgyzstan"),
 *                      @OA\Property(property="name", type="string", example="Кыргызстан"),
 *                      @OA\Property(property="image", type="string", example="Test.png"),
 *                      @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *               )
 *           )
 *       ),
 *       @OA\Response(
 *            response=404,
 *            description="Not Found",
 *            @OA\JsonContent(
 *                @OA\Property(property="status", type="integer", example=404),
 *                @OA\Property(property="success", type="boolean", example=false),
 *                @OA\Property(property="error", type="string", example="not_found."),
 *                @OA\Property(property="message", type="string", example="Not found.")
 *            )
 *       )
 *  ),
 *
 * @OA\Get(
 *        path="/api/v1/destinations/travel/{destinations}",
 *        summary="Show Travel-Destinations in Destination",
 *        tags={"Destinations"},
 *
 *        @OA\Parameter(
 *            name="destinations",
 *            in="path",
 *            required=true,
 *            description="ID destinations",
 *            example=1
 *        ),
 *
 *        @OA\Parameter(
 *           name="Accept-Language",
 *           in="header",
 *           required=true,
 *           @OA\Schema(
 *               type="string",
 *               example="en",
 *               enum={"en", "ru", "kg", "kz", "tj", "tm", "uz"}
 *           ),
 *           description="Language preference for the response. Default is 'en'. Possible values: 'en', 'ru', 'kg', 'kz', 'tj', 'tm', 'uz'."
 *       ),
 *
 *        @OA\Response(
 *            response=200,
 *            description="Ok",
 *            @OA\JsonContent(
 *                @OA\Property(property="status", type="integer", example=200),
 *                @OA\Property(property="success", type="boolean", example=true),
 *                @OA\Property(property="data", type="array",
 *                     @OA\Items(type="object",
 *                          @OA\Property(property="slug", type="string", example="1-altyn-arashan"),
 *                          @OA\Property(property="name", type="string", example="Алатын-Арашан"),
 *                     ),
 *                )
 *            )
 *        ),
 *        @OA\Response(
 *             response=404,
 *             description="Not Found",
 *             @OA\JsonContent(
 *                 @OA\Property(property="status", type="integer", example=404),
 *                 @OA\Property(property="success", type="boolean", example=false),
 *                 @OA\Property(property="error", type="string", example="not_found."),
 *                 @OA\Property(property="message", type="string", example="Not found.")
 *             )
 *        )
 *   ),
 *
 * @OA\Get(
 *         path="/api/v1/destinations/groupTours/{destinations}",
 *         summary="Show Group-Tours in Destination",
 *         tags={"Destinations"},
 *
 *         @OA\Parameter(
 *             name="destinations",
 *             in="path",
 *             required=true,
 *             description="ID destinations",
 *             example=1
 *         ),
 *
 *         @OA\Parameter(
 *            name="Accept-Language",
 *            in="header",
 *            required=true,
 *            @OA\Schema(
 *                type="string",
 *                example="en",
 *                enum={"en", "ru", "kg", "kz", "tj", "tm", "uz"}
 *            ),
 *            description="Language preference for the response. Default is 'en'. Possible values: 'en', 'ru', 'kg', 'kz', 'tj', 'tm', 'uz'."
 *        ),
 *
 *         @OA\Response(
 *             response=200,
 *             description="Ok",
 *             @OA\JsonContent(
 *                 @OA\Property(property="status", type="integer", example=200),
 *                 @OA\Property(property="success", type="boolean", example=true),
 *                 @OA\Property(property="data", type="array",
 *                    @OA\Items(type="object",
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="travel_destination", type="string", example="Алатын-Арашан"),
 *                      @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                      @OA\Property(property="image", type="string", example="Test.png"),
 *                      @OA\Property(property="date", type="string", example="5D/4N"),
 *                      @OA\Property(property="price", type="integer", example=10000),
 *                      @OA\Property(property="description", type="string", example="Test test hello this is test description"),
 *                      @OA\Property(property="peoples", type="integer", example=10),
 *                      @OA\Property(property="inclusions", type="string", example="this inclusions"),
 *                      @OA\Property(property="exclusions", type="string", example="this exclusions"),
 *                    )
 *                 )
 *             )
 *         ),
 *         @OA\Response(
 *              response=404,
 *              description="Not Found",
 *              @OA\JsonContent(
 *                  @OA\Property(property="status", type="integer", example=404),
 *                  @OA\Property(property="success", type="boolean", example=false),
 *                  @OA\Property(property="error", type="string", example="not_found."),
 *                  @OA\Property(property="message", type="string", example="Not found.")
 *              )
 *         )
 *    ),
 *
 * @OA\Get(
 *          path="/api/v1/destinations/privateTours/{destinations}",
 *          summary="Show Private-Tours in Destination",
 *          tags={"Destinations"},
 *
 *          @OA\Parameter(
 *              name="destinations",
 *              in="path",
 *              required=true,
 *              description="ID destinations",
 *              example=1
 *          ),
 *
 *          @OA\Parameter(
 *             name="Accept-Language",
 *             in="header",
 *             required=true,
 *             @OA\Schema(
 *                 type="string",
 *                 example="en",
 *                 enum={"en", "ru", "kg", "kz", "tj", "tm", "uz"}
 *             ),
 *             description="Language preference for the response. Default is 'en'. Possible values: 'en', 'ru', 'kg', 'kz', 'tj', 'tm', 'uz'."
 *         ),
 *
 *          @OA\Response(
 *              response=200,
 *              description="Ok",
 *              @OA\JsonContent(
 *                  @OA\Property(property="status", type="integer", example=200),
 *                  @OA\Property(property="success", type="boolean", example=true),
 *                  @OA\Property(property="data", type="array",
 *                     @OA\Items(type="object",
 *                       @OA\Property(property="id", type="integer", example=1),
 *                       @OA\Property(property="travel_destination", type="string", example="Алатын-Арашан"),
 *                       @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                       @OA\Property(property="image", type="string", example="Test.png"),
 *                       @OA\Property(property="date", type="string", example="5D/4N"),
 *                       @OA\Property(property="description", type="string", example="Test test hello this is test description"),
 *                       @OA\Property(property="inclusions", type="string", example="this inclusions"),
 *                       @OA\Property(property="exclusions", type="string", example="this exclusions")
 *                     )
 *                  )
 *              )
 *          ),
 *          @OA\Response(
 *               response=404,
 *               description="Not Found",
 *               @OA\JsonContent(
 *                   @OA\Property(property="status", type="integer", example=404),
 *                   @OA\Property(property="success", type="boolean", example=false),
 *                   @OA\Property(property="error", type="string", example="not_found."),
 *                   @OA\Property(property="message", type="string", example="Not found.")
 *               )
 *          )
 *     ),
 *
 * @OA\Get(
 *           path="/api/v1/destinations/popular/{destinations}",
 *           summary="Show Popular-Tours in Destination",
 *           tags={"Destinations"},
 *
 *           @OA\Parameter(
 *               name="destinations",
 *               in="path",
 *               required=true,
 *               description="ID destinations",
 *               example=1
 *           ),
 *
 *           @OA\Parameter(
 *              name="Accept-Language",
 *              in="header",
 *              required=true,
 *              @OA\Schema(
 *                  type="string",
 *                  example="en",
 *                  enum={"en", "ru", "kg", "kz", "tj", "tm", "uz"}
 *              ),
 *              description="Language preference for the response. Default is 'en'. Possible values: 'en', 'ru', 'kg', 'kz', 'tj', 'tm', 'uz'."
 *          ),
 *
 *           @OA\Response(
 *               response=200,
 *               description="Ok",
 *               @OA\JsonContent(
 *                   @OA\Property(property="status", type="integer", example=200),
 *                   @OA\Property(property="success", type="boolean", example=true),
 *                   @OA\Property(property="data", type="array",
 *                      @OA\Items(type="object",
 *                        @OA\Property(property="id", type="integer", example=1),
 *                        @OA\Property(property="travel_destination", type="string", example="Алатын-Арашан"),
 *                        @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                        @OA\Property(property="description", type="string", example="Test test hello this is test description"),
 *                        @OA\Property(property="date", type="string", example="5D/4N"),
 *                        @OA\Property(property="image", type="string", example="Test.png"),
 *                      )
 *                   )
 *               )
 *           ),
 *           @OA\Response(
 *                response=404,
 *                description="Not Found",
 *                @OA\JsonContent(
 *                    @OA\Property(property="status", type="integer", example=404),
 *                    @OA\Property(property="success", type="boolean", example=false),
 *                    @OA\Property(property="error", type="string", example="not_found."),
 *                    @OA\Property(property="message", type="string", example="Not found.")
 *                )
 *           )
 *      ),
 *
 * @OA\Get(
 *      path="/api/v1/destinations/transport/{destinations}",
 *      summary="Show Transport in Destination",
 *      tags={"Destinations"},
 *
 *      @OA\Parameter(
 *          name="destinations",
 *          in="path",
 *          required=true,
 *          description="ID destinations",
 *          example=1
 *      ),
 *
 *      @OA\Parameter(
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
 *      @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="integer", example=200),
 *              @OA\Property(property="success", type="boolean", example=true),
 *              @OA\Property(property="data", type="array",
 *                 @OA\Items(type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="destination", type="string", example="Кыргызстан"),
 *                   @OA\Property(property="image", type="string", example="Test.png"),
 *                   @OA\Property(property="description", type="string", example="Test test hello this is test description"),
 *                   @OA\Property(property="sedan", type="integer", example=50),
 *                   @OA\Property(property="van", type="integer", example=70),
 *                   @OA\Property(property="suv", type="integer", example=80),
 *                   @OA\Property(property="mini_van", type="integer", example=90),
 *                 )
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *           response=404,
 *           description="Not Found",
 *           @OA\JsonContent(
 *               @OA\Property(property="status", type="integer", example=404),
 *               @OA\Property(property="success", type="boolean", example=false),
 *               @OA\Property(property="error", type="string", example="not_found."),
 *               @OA\Property(property="message", type="string", example="Not found.")
 *           )
 *      )
 * ),
 */
class DestinationController extends Controller
{

}
