<?php

namespace App\Services;

interface TimeService {

    public function currentTime(int $offset): int;
}