<?php

namespace App\Riot;

trait RateLimiter {

    public static $calls = 0;

    protected static $startTime;

    protected static $timer;

    protected function startClock() {
        self::$startTime = microtime(true);
    }

    protected function limitRate()
    {
        if (self::$calls >= self::MAX_CALLS_PER_TWO_MINUTES && self::$timer < self::TWO_MINUTES ) {
            $this->wait(self::TWO_MINUTES);
            $this->resetClock();
        }
    }

    protected function wait($duration) {
        echo 'Shit has to wait for ' . self::TWO_MINUTES . ' seconds, so give it a goddamn rest';
        echo '<br>';
        sleep($duration);
    }

    protected function resetClock()
    {
        self::$startTime = self::$timer = null;
        self::$calls = 0;
    }

    protected function tick()
    {
        self::$timer = microtime(true) - self::$startTime;
    }
}