<?php

namespace App\Traits;

use App\Models\User;
use DateTimeInterface;

trait SerializeDateFormate
{
    /**
     * serializeDate
     *
     * @param  mixed $date
     * @return void
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->shorterDiffForHumans();
    }
}