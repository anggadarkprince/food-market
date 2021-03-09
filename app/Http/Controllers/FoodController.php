<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use App\Models\Restaurant;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class FoodController extends Controller
{
    /**
     * Display a listing of the food.
     *
     * @return Response|View
     */
    public function index()
    {
        $foods = Food::with('restaurant')->paginate(10);

        return view('foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new food.
     *
     * @return Response|View
     */
    public function create()
    {
        $restaurants = Restaurant::all();

        return view('foods.create', compact('restaurants'));
    }

    /**
     * Store a newly created food in storage.
     *
     * @param FoodRequest $request
     * @return Response|RedirectResponse
     */
    public function store(FoodRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('assets/foods', 'public');

        Food::create($data);

        return redirect()->route('foods.index');
    }

    /**
     * Display the specified food.
     *
     * @param Food $food
     * @return Response|View
     */
    public function show(Food $food)
    {
        return view('foods.show', compact('food'));
    }

    /**
     * Show the form for editing the specified food.
     *
     * @param Food $food
     * @return Response|View
     */
    public function edit(Food $food)
    {
        $restaurants = Restaurant::all();

        return view('foods.edit', compact('food', 'restaurants'));
    }

    /**
     * Update the specified food in storage.
     *
     * @param FoodRequest $request
     * @param Food $food
     * @return Response|RedirectResponse
     */
    public function update(FoodRequest $request, Food $food)
    {
        $data = $request->validated();

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('assets/foods', 'public');
        }

        $food->update($data);

        return redirect()->route('foods.index');
    }

    /**
     * Remove the specified food from storage.
     *
     * @param Food $food
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function destroy(Food $food)
    {
        $food->delete();

        return redirect()->route('foods.index');
    }
}
