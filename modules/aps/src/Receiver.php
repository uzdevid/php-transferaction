<?php

namespace uzdevid\transferaction\modules\aps\src;

use uzdevid\transferaction\modules\aps\Aps;

/**
 * @property Aps $aps
 */
class Receiver extends Request {
    public $aps;

    public function __construct($aps) {
        $this->aps = $aps;
    }

    public function info($card) {
        $raw = [
            'headers' => [
                "token: {$this->aps->token}",
                "device-id: {$this->aps->device_id}"
            ],
            'aps' => [
                'card' => $card
            ]
        ];

        return $this->headers($this->aps->headers())
            ->raw($raw)
            ->url($this->aps->baseUrl, $this->aps->version, 'receiver/info')
            ->sendPost();
    }
}