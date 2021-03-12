<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodCollection;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FoodController extends Controller
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
        $foodName = $request->input('food_name');
        $category = $request->input('category');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $minRate = $request->input('min_rate');
        $maxRate = $request->input('max_rate');

        if ($id) {
            return $this->show($request, $id);
        }

        $food = Food::query()->with('restaurant');
        if ($foodName) {
            $food->where('food_name', 'like', '%' . $foodName . '%');
        }
        if ($category) {
            $food->where('category', 'like', '%' . $category . '%');
        }
        if ($minPrice) {
            $food->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $food->where('price', '<=', $maxPrice);
        }
        if ($minRate) {
            $food->where('rating', '>=', $minRate);
        }
        if ($maxRate) {
            $food->where('rating', '<=', $maxPrice);
        }

        return FoodResource::collection($food->paginate($limit));
    }

    /**
     * Show food data.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $food = Food::with('restaurant')->find($id);

        if ($food) {
            return ResponseFormatter::success($food, 'Food Fetched');
        } else {
            return ResponseFormatter::error(null, 'Food Not Found', 404);
        }
    }
}
