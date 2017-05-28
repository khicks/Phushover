<?php

namespace Phushover;

use Phushover\Exceptions\InvalidArgumentException;
use Phushover\Exceptions\PhushoverException;

class Client {
    const API_URL = "https://api.pushover.net/1/messages.json";

    private $user;
    private $token;

    public function __construct($user=null, $token=null) {
        $this->user = $user;
        $this->token = $token;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user=null) {
        $this->user = $user;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token=null) {
        $this->token = $token;
    }

    public function send(Message $message, $device = null) {
        if (!$message instanceof Message) {
            throw new InvalidArgumentException("Message parameter must be an instance of Message.");
        }

        if (empty($message->getMessage())) {
            throw new PhushoverException("Message content is empty.");
        }

        if ($message->getPriority() == Priority::EMERGENCY) {
            if (is_null($message->getRetry())) {
                throw new PhushoverException("Emergency messages must have the \"retry\" parameter.");
            }
            if (is_null($message->getExpire())) {
                throw new PhushoverException("Emergency messages must have the \"expire\" parameter.");
            }
        }

        $params = $message->getAllParams();

        $params['user'] = $this->user;
        $params['token'] = $this->token;

        if (!is_null($device)) {
            $params['device'] = $device;
        }

        return $this->apiCall($params);
    }

    public function apiCall($params) {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_USERAGENT => "Phushover: PHP wrapper for Pushover.net",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $params
        );

        $ch = curl_init(self::API_URL);
        curl_setopt_array($ch, $options);

        $response_raw = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response_raw);
        if ($json_error = json_last_error()) {
            $response = $response_raw;
        }

        return $response;
    }
}