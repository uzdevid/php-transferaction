<?php

namespace uzdevid\transferaction\modules\aps\src;

use uzdevid\transferaction\modules\aps\Aps;

/**
 * @property Aps $aps
 */
class Transaction extends Request {
    public $aps;

    public function __construct($aps) {
        $this->aps = $aps;
    }

    public function transfer($hold_id, $sms_code = null) {
        $raw = [
            'headers' => [
                "token: {$this->aps->token}",
                "device-id: {$this->aps->device_id}"
            ],
            'aps' => [
                'operationHoldId' => $hold_id,
                'smsCode' => $sms_code
            ]
        ];
        
        return $this->headers($this->aps->headers())
            ->raw($raw)
            ->url($this->aps->baseUrl, $this->aps->version, 'transaction/transfer')
            ->sendPost();
    }
}