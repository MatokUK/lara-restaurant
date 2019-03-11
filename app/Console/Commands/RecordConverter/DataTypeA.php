<?php

namespace App\Console\Command\RecordConverter;

use App\Console\Commands\RestaurantAdapter\RestaurantAdapter;
use App\Console\Commands\RestaurantAdapter\OpeningInterval;
//use App\Entity\Restaurant;

class DataTypeA extends AbstractConverter
{
    protected $length = 10;

    public function createRestaurant(array $data): RestaurantAdapter
    {
        $this->checkLength($data);

        $restaurant = new RestaurantAdapter();

        foreach ($this->readIntervals($data[5], $data[3], $data[4]) as $interval) {
            $restaurant->addOpeningInterval($interval);
        }

        return $restaurant->setTitle($data[0])
            ->setCuisine($data[2])
            ->setDescription($data[9]);
    }

    private function readIntervals(string $days, string $open, string $close)
    {
        $days = explode(',', $days);
        $days = array_map(['App\Util\Date', 'shortDayNameToNumeric'], $days);

        foreach ($days as $day) {
            $interval = new OpeningInterval();
            $interval->setDayInWeek($day)
                ->setOpenAt(new \DateTime($open))
                ->setCloseAt(new \DateTime($close));

            yield $interval;
        }
    }
}