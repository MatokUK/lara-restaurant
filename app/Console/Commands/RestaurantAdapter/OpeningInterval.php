<?php

namespace App\Console\Commands\RestaurantAdapter;
use App\OpeningInterval as LaravelOpeningInterval;

class OpeningInterval
{
    private $dayInWeek;

    private $openAt;

    private $closeAt;

    public function setDayInWeek(int $dayInWeek)
    {
        $this->dayInWeek = $dayInWeek;
        return $this;
    }

    public function setOpenAt(\DateTime $openAt)
    {
        $this->openAt = $openAt;
        return $this;
    }

    public function setCloseAt(\DateTime $closeAt)
    {
        $this->closeAt = $closeAt;
        return $this;
    }

    public function getInterval()
    {
        $interval = new LaravelOpeningInterval();
        $interval->day_in_week = $this->dayInWeek;
        $interval->open_at = $this->openAt;
        $interval->close_at = $this->closeAt;

        return $interval;
    }
}