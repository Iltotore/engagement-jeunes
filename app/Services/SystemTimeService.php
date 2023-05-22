<?php

namespace App\Services;

class SystemTimeService implements TimeService {

    public function currentTime(int $offset): int {
        return time()+$offset;
    }
}