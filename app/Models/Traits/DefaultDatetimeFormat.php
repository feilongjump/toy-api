<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait DefaultDatetimeFormat
{
    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format(Carbon::DEFAULT_TO_STRING_FORMAT);
    }
}