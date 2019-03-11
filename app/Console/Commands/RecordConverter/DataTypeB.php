<?php

namespace App\Console\Command\RecordConverter;

use App\Console\Commands\RestaurantAdapter\RestaurantAdapter;
use App\Console\Commands\RestaurantAdapter\OpeningInterval;
use App\Util\DateTimeExpression;

class DataTypeB extends AbstractConverter
{
    protected $length = 2;
    public function createRestaurant(array $data): RestaurantAdapter
    {
        $this->checkLength($data);
        $restaurant = new RestaurantAdapter();
        foreach ($this->readIntervals($data[1]) as $interval) {
            $restaurant->addOpeningInterval($interval);
        }
        return $restaurant->setTitle($data[0]);
    }
    private function readIntervals(string $intervalExpression)
    {
        $dates = DateTimeExpression::parseExpression($intervalExpression);
        foreach ($dates as $date) {
            $interval = new OpeningInterval();
            yield $interval->setDayInWeek($date->dayNumber)
                ->setOpenAt($date->start)
                ->setCloseAt($date->end);
        }
    }
}