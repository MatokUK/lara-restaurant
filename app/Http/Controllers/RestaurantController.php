<?php

namespace App\Http\Controllers;

use App\Repository\RestaurantRepository;
use App\Restaurant;
use App\Restaurant\RestaurantDate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    /**
     * @param  Request $request
     * @param  RestaurantRepository $restaurantRepository
     * @return Response
     */
    public function listing(Request $request, RestaurantRepository $restaurantRepository)
    {
        $searchTerm = $request->query->get('s', '');
        $closed = $request->query->getBoolean('closed');

        return view('list', [
            'restaurants' => $this->getRestaurantList($request, $restaurantRepository),
            'search' => $searchTerm,
            'closed' => $closed,
        ]);
    }

    /**
     * @param  Request $request
     * @param  RestaurantRepository $restaurantRepository
     * @return string
     */
    public function search(Request $request, RestaurantRepository $restaurantRepository)
    {
        $restaurants = $this->getRestaurantList($request, $restaurantRepository);
        $content = view('table', ['restaurants' => $restaurants]);

        return response()->json((string) $content);
    }

    private function getRestaurantList(Request $request, RestaurantRepository $restaurantRepository)
    {
        $searchTerm = (string) $request->query->get('s', '');
        $restaurantDate = null;
        if (0 === $request->query->getInt('closed', 0)) {
            $restaurantDate = new RestaurantDate();
        }

        return $restaurantRepository->search($searchTerm, $restaurantDate);
    }
}