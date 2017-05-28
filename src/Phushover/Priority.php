<?php

namespace Phushover;

class Priority {
    const LOWEST = -2;
    const LOW = -1;
    const NORMAL = 0;
    const HIGH = 1;
    const EMERGENCY = 2;

    public static function getPriorities() {
        return array(
            self::LOWEST,
            self::LOW,
            self::NORMAL,
            self::HIGH,
            self::EMERGENCY
        );
    }

    public static function has($priority) {
        return in_array($priority, self::getPriorities());
    }
}