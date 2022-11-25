<?php

namespace uzdevid\transferaction\modules\aps\src;

use uzdevid\transferaction\modules\aps\Aps;
use uzdevid\transferaction\modules\aps\src\card\AnorMaster;
use uzdevid\transferaction\modules\aps\src\card\AttoCard;
use uzdevid\transferaction\modules\aps\src\card\Humo;
use uzdevid\transferaction\modules\aps\src\card\Master;
use uzdevid\transferaction\modules\aps\src\card\Uzcard;
use uzdevid\transferaction\modules\aps\src\card\Visa;

/**
 * @property Aps $aps
 */
class Card {
    public $aps;
    public $name;

    public function __construct($aps) {
        $this->aps = $aps;
    }

    public function uzcard() {
        $this->name = 'uzcard';
        return new Uzcard($this);
    }

    public function humo() {
        $this->name = 'humo';
        return new Humo($this);
    }

    public function visa() {
        $this->name = 'visa';
        return new Visa($this);
    }

    public function master() {
        $this->name = 'master';
        return new Master($this);
    }

    public function anorMaster() {
        $this->name = 'anor-master';
        return new AnorMaster($this);
    }

    public function attoCard() {
        $this->name = 'atto-card';
        return new AttoCard($this);
    }

    public function headers() {
        return [
            "token: {$this->aps->token}",
            "device-id: {$this->aps->device_id}"
        ];
    }
}