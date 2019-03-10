<?php

namespace App\Repository;

use App\Restaurant\RestaurantDate;

class RestaurantRepository
{
    public function search(string $searchTerm, RestaurantDate $date = null)
    {
        if (null == $date) {
            return $this->searchByName($searchTerm);
        }
        return $this->searchByNameAndOpeningHours($searchTerm, $date);
    }
    private function searchByName(string $searchTerm)
    {
        return \App\Restaurant::where('title', 'like', '%'.$searchTerm.'%')
            ->orWhere('cuisine', 'like', '%'.$searchTerm.'%')
            ->orWhere('description', 'like', '%'.$searchTerm.'%')
            ->take(100)->get();
    }
    private function searchByNameAndOpeningHours(string $searchTerm, RestaurantDate $date)
    {
        return \App\Restaurant::where(function ($query) use ($searchTerm) {
                    $query
                        ->where('title', 'like', '%'.$searchTerm.'%')
                        ->orWhere('cuisine', 'like', '%'.$searchTerm.'%')
                        ->orWhere('description', 'like', '%'.$searchTerm.'%')
                    ;
                })
                ->whereHas('openingIntervals', function ($query) use ($date) {
                    $query->where('day_in_week', $date->getDayInWeek())
                          ->where('open_at', '<=', $date->getTime())
                          ->where('close_at', '>=', $date->getTime());
                })
                ->take(100)->get();
    }
}