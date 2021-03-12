<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RestaurantController extends Controller
{
    /**
     * Show all food data.
     *
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $restaurantName = $request->input('restaurant_name');

        if ($id) {
            return $this->show($request, $id);
        }

        $restaurant = Restaurant::query()->with('foods');
        if ($restaurantName) {
            $restaurant->where('restaurant_name', 'like', '%' . $restaurantName . '%');
        }

        return RestaurantResource::collection($restaurant->paginate($limit));
    }

    /**
     * Show restaurant data.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $restaurant = Restaurant::with('foods')->find($id);

        if ($restaurant) {
            return ResponseFormatter::success($restaurant, 'Restaurant Fetched');
        } else {
            return ResponseFormatter::error(null, 'Restaurant Not Found', 404);
        }
    }
}
