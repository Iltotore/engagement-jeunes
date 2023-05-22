<?php

namespace App\Services;

class FrozenTimeService implements TimeService {

    private int $current;

    public function __construct(int $current) {
        $this->current = $current;
    }

    public function currentTime(int $offset): int {
        return $this->current+$offset;
    }
}