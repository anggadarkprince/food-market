<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the restaurant.
     *
     * @return Response|View
     */
    public function index()
    {
        $restaurants = Restaurant::paginate(10);

        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new restaurant.
     *
     * @return Response|View
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created restaurant in storage.
     *
     * @param RestaurantRequest $request
     * @return Response|RedirectResponse
     */
    public function store(RestaurantRequest $request)
    {
        $data = $request->validated();

        Restaurant::create($data);

        return redirect()->route('restaurants.index');
    }

    /**
     * Display the specified restaurant.
     *
     * @param Restaurant $restaurant
     * @return Response|View
     */
    public function show(Restaurant $restaurant)
    {
        return view('restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified restaurant.
     *
     * @param Restaurant $restaurant
     * @return Response|View
     */
    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified restaurant in storage.
     *
     * @param RestaurantRequest $request
     * @param Restaurant $restaurant
     * @return Response|RedirectResponse
     */
    public function update(RestaurantRequest $request, Restaurant $restaurant)
    {
        $data = $request->validated();

        $restaurant->update($data);

        return redirect()->route('restaurants.index');
    }

    /**
     * Remove the specified restaurant from storage.
     *
     * @param Restaurant $restaurant
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('restaurants.index');
    }
}
