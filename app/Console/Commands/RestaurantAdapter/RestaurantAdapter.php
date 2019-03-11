<?php

namespace App\Console\Commands\RestaurantAdapter;

use App\Restaurant;

class RestaurantAdapter
{
    private $title;

    private $cuisine;

    private $description;

    private $openingIntervals;

    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function setCuisine(string $cuisine)
    {
        $this->cuisine = $cuisine;

        return $this;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function addOpeningInterval($interval)
    {
        $this->openingIntervals[] = $interval;

        return $this;
    }

    public function getRestaurant()
    {
        $restaurant = new Restaurant();

        $restaurant->title = $this->title;
        $restaurant->cuisine = $this->cuisine;
        $restaurant->description = $this->description;

        return $restaurant;
    }

    public function getIntervals()
    {
        $result = [];
        foreach ($this->openingIntervals as $interval) {
            $result[] = $interval->getInterval();
        }

        return $result;
    }
}