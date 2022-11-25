<?php

namespace uzdevid\transferaction;

use uzdevid\transferaction\modules\aps\Aps;
use uzdevid\transferaction\modules\aps\src\Transfer;
use uzdevid\transferaction\src\Project;

/**
 * @property string $baseUrl
 * @property string $version
 *
 * @property string $token
 * @property string $device_id
 * @property string $securityKey
 * @property string $bearerToken
 */
class Transferaction {
    public $baseUrl = "https://api.transferaction.uz";
    public $version = "v1";

    public $securityKey;
    public $bearerToken;

    public function __construct($securityKey, $bearerToken = null) {
        $this->securityKey = $securityKey;
        $this->bearerToken = $bearerToken;
    }

    public function project() {
        return new Project($this);
    }

    public function aps() {
        return new Aps($this);
    }

    public function headers() {
        return [
            "Security-Key: {$this->securityKey}",
            "Authorization: Bearer {$this->bearerToken}",
            "Content-Type: application/json",
        ];
    }
}
