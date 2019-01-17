<?php

namespace Phushover;

use Phushover\Exceptions\InvalidArgumentException;

class Message {
    private $message;
    private $title;
    private $url;
    private $url_title;
    private $priority;
    private $timestamp;
    private $sound;
    private $is_html;
    private $retry;
    private $expire;
    private $callback;

    public function __construct($message=null, $title=null, $priority=Priority::NORMAL) {
        $this->message = $message;
        $this->title = $title;
        $this->url = null;
        $this->url_title = null;
        $this->priority = $priority;
        $this->timestamp = null;
        $this->sound = null;
        $this->is_html = false;
        $this->retry = null;
        $this->expire = null;
        $this->callback = null;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getURL() {
        return $this->url;
    }

    public function setURL($url) {
        $this->url = $url;
    }

    public function getURLTitle() {
        return $this->url_title;
    }

    public function setURLTitle($url_title) {
        $this->url_title = $url_title;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function setPriority($priority) {
        if (!Priority::has($priority)) {
            throw new InvalidArgumentException("Priority \"{$priority}\" is invalid.");
        }
        $this->priority = $priority;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTime $timestamp) {
        if (!($timestamp instanceof \DateTime || is_null($timestamp))) {
            throw new InvalidArgumentException("Timestamp must be an instance of PHP DateTime.");
        }
        $this->timestamp = $timestamp;
    }

    public function getSound() {
        return $this->sound;
    }

    public function setSound($sound) {
        if (!(Sound::has($sound) || is_null($sound))) {
            throw new InvalidArgumentException("Sound \"{$sound}\" is invalid.");
        }
        $this->sound = $sound;
    }

    public function isHTML() {
        return $this->is_html;
    }

    public function setIsHTML($is_html) {
        $this->is_html = ($is_html) ? true : false;
    }

    public function getRetry() {
        return $this->retry;
    }

    public function setRetry($retry) {
        if (is_null($retry)) {
            $retry = null;
        }

        if (!is_int($retry)) {
            throw new InvalidArgumentException("Retry argument must be an integer.");
        }
        if ($retry < 30) {
            throw new InvalidArgumentException("Retry argument must be at least 30 seconds.");
        }
        $this->retry = $retry;
    }

    public function getExpire() {
        return $this->expire;
    }

    public function setExpire($expire) {
        if (is_null($expire)) {
            $expire = null;
        }

        if (!is_int($expire)) {
            throw new InvalidArgumentException("Expire argument must be an integer.");
        }
        if ($expire > 10800) {
            throw new InvalidArgumentException("Expire argument must be no greater than 10800 seconds.");
        }
        $this->expire = $expire;
    }

    function getCallback() {
        return $this->callback;
    }

    public function setCallback($callback) {
        $this->callback = $callback;
    }

    public function getAllParams() {
        //TODO: Return only set parameters
        return array(
            'message' => $this->message,
            'title' => $this->title,
            'url' => $this->url,
            'url_title' => $this->url_title,
            'priority' => $this->priority,
            'timestamp' => $this->timestamp,
            'sound' => $this->sound,
            'html' => $this->is_html,
            'retry' => $this->retry,
            'expire' => $this->expire,
            'callback' => $this->callback
        );
    }

    public function setParams($params) {
        if (isset($params['message'])) $this->setMessage($params['message']);
        if (isset($params['title'])) $this->setTitle($params['title']);
        if (isset($params['url'])) $this->setURL($params['url']);
        if (isset($params['url_title'])) $this->setURLTitle($params['url_title']);
        if (isset($params['priority'])) $this->setPriority($params['priority']);
        if (isset($params['timestamp'])) $this->setTimestamp($params['timestamp']);
        if (isset($params['sound'])) $this->setSound($params['sound']);
        if (isset($params['html'])) $this->setIsHTML($params['html']);
        if (isset($params['retry'])) $this->setRetry($params['retry']);
        if (isset($params['expire'])) $this->setExpire($params['expire']);
        if (isset($params['callback'])) $this->setCallback($params['callback']);
    }
}
