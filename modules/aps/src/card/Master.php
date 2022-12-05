<?php

namespace uzdevid\transferaction\modules\aps\src\card;

use uzdevid\transferaction\modules\aps\src\Card;
use uzdevid\transferaction\modules\aps\src\Request;

/**
 * @property Card $card
 */
class Master extends Request {
    public $card;

    public function __construct($card) {
        $this->card = $card;
    }

    public function all() {
        return $this->cardRequest("card/{$this->card->name}");
    }

    public function info($id) {
        $response = $this->all();
        if (@$response['aps']['data'] == null)
            return $response;
        foreach ($response['aps']['data'] as $card)
            if ($card['id'] == $id)
                return ['ok' => true, 'aps' => ['data' => $card]];
        return ['ok' => false, 'error' => 'card not found'];
    }

    public function toService($params) {
        return $this->cardRequest("{$this->card->name}/service", $params);
    }

    public function toHumo($params) {
        return $this->cardRequest("{$this->card->name}/humo", $params);
    }

    public function toUzcard($params) {
        return $this->cardRequest("{$this->card->name}/uzcard", $params);
    }

    public function toVisa($params) {
        return $this->cardRequest("{$this->card->name}/visa", $params);
    }

    public function toMaster($params) {
        return $this->cardRequest("{$this->card->name}/master", $params);
    }

    public function toAnorMaster($params) {
        return $this->cardRequest("{$this->card->name}/anor-master", $params);
    }

    public function toAttoCard($params) {
        return $this->cardRequest("{$this->card->name}/atto-card", $params);
    }
}