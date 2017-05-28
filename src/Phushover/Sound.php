<?php

namespace Phushover;

class Sound {
    const PUSHOVER = 'pushover';
    const BIKE = 'bike';
    const BUGLE = 'bugle';
    const CASHREGISTER = 'cashregister';
    const CLASSICAL = 'classical';
    const COSMIC = 'cosmic';
    const FALLING = 'falling';
    const GAMELAN = 'gamelan';
    const INCOMING = 'incoming';
    const INTERMISSION = 'intermission';
    const MAGIC = 'magic';
    const MECHANICAL = 'mechanical';
    const PIANOBAR = 'pianobar';
    const SIREN = 'siren';
    const SPACEALARM = 'spacealarm';
    const TUGBOAT = 'tugboat';
    const ALIEN = 'alien';
    const CLIMB = 'climb';
    const PERSISTENT = 'persistent';
    const ECHOSOUND = 'echo';
    const UPDOWN = 'updown';
    const NONE = 'none';

    public static function getSounds() {
        return array(
            self::PUSHOVER,
            self::BIKE,
            self::BUGLE,
            self::CASHREGISTER,
            self::CLASSICAL,
            self::COSMIC,
            self::FALLING,
            self::GAMELAN,
            self::INCOMING,
            self::INTERMISSION,
            self::MAGIC,
            self::MECHANICAL,
            self::PIANOBAR,
            self::SIREN,
            self::SPACEALARM,
            self::TUGBOAT,
            self::ALIEN,
            self::CLIMB,
            self::PERSISTENT,
            self::ECHOSOUND,
            self::UPDOWN,
            self::NONE
        );
    }

    public static function has($sound) {
        return in_array($sound, self::getSounds());
    }
}