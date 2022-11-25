<?php

namespace uzdevid\transferaction\modules\aps;

use uzdevid\transferaction\modules\aps\src\Card;
use uzdevid\transferaction\modules\aps\src\Humo;
use uzdevid\transferaction\modules\aps\src\Project;
use uzdevid\transferaction\modules\aps\src\Receiver;
use uzdevid\transferaction\modules\aps\src\Transaction;

/**
 * @property Transferaction $base
 * @property string $baseUrl
 * @property string $version
 * @property string $token
 * @property string $device_id
 */
class Aps {
    public $base;

    public $baseUrl = "https://api.transferaction.uz/aps";
    public $version = "v1";

    public $token;
    public $device_id;

    public function __construct($base) {
        $this->base = $base;
    }

    public function setToken($token) {
        $this->token = $token;
        return $this;
    }

    public function setDeviceId($device_id) {
        $this->device_id = $device_id;
        return $this;
    }

    public function card() {
        return new Card($this);
    }

    public function transaction() {
        return new Transaction($this);
    }

    public function receiver() {
        return new Receiver($this);
    }

    public function headers() {
        return [
            "Security-Key: {$this->base->securityKey}",
            "Authorization: Bearer {$this->base->bearerToken}",
            "Content-Type: application/json",
        ];
    }
}