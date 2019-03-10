<?php

namespace App\Restaurant;

use App\Restaurant;

class Availability
{
    /** @var \DateTime */
    private $date;

    public function __construct($date = null)
    {
        $this->date = new \DateTime($date);
    }

    public function isOpen(Restaurant $restaurant): bool
    {
        foreach ($restaurant->openingIntervals as $openingInterval) {
            if ($this->sameDay($openingInterval) && $this->openAtTime($openingInterval)) {
                return true;
            }
        }
        return false;
    }
    private function sameDay($openingInterval): bool
    {
        return $this->date->format('N') == $openingInterval->day_in_week;
    }

    private function openAtTime($openingInterval): bool
    {
        $currentTime = (int) $this->date->format('Gi');
        $start = (int) (new \DateTime($openingInterval->open_at))->format('Hi');
        $end = (int) (new \DateTime($openingInterval->close_at))->format('Hi');

        return $start <= $currentTime && $currentTime < $end;
    }
}