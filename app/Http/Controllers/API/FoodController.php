<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function all(Request $request)
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
            $food = Food::with('restaurant')->find($id);

            if ($food) {
                return ResponseFormatter::success($food, 'Food Fetched');
            } else {
                return ResponseFormatter::error(null, 'Food Not Found', 404);
            }
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

        return ResponseFormatter::success($food->paginate($limit), 'Food Fetched');
    }
}
