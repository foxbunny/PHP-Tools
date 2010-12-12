<?php

class Timer {

    private static $start;
    private static $started;

    private static function getTime() {
        return microtime(TRUE);
    }

    public static function start() {
        self::$start = self::getTime();
        self::$started = TRUE;
    }

    public static function stop() {
        if (self::$started) {
            $endtime = self::getTime();
            return $endtime - self::$start;
        }
        else {
            throw new Exception('Timer was not started.');
        }
    }
}

?>
