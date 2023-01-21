<?php

namespace uzdevid\transferaction\modules\aps\src;

class Request {
    protected $url;
    protected $headers;
    protected $raw;
    protected $timeout = 0;

    protected function sendPost() {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->raw, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    protected function url($base, $version, $path) {
        $this->url = "{$base}/{$version}/{$path}";
        return $this;
    }

    protected function headers($headers) {
        $this->headers = $headers;
        return $this;
    }

    protected function raw($raw) {
        $this->raw = $raw;
        return $this;
    }

    protected function timeout($seconds) {
        $this->timeout = $seconds;
        return $this;
    }

    protected function cardRequest($path, $params = []) {
        $raw = [
            'headers' => [
                "token: {$this->card->aps->token}",
                "device-id: {$this->card->aps->device_id}"
            ]
        ];

        if (!empty($params)) {
            $raw['aps'] = $params;
        }

        return $this->headers($this->card->aps->headers())
            ->raw($raw)
            ->url($this->card->aps->baseUrl, $this->card->aps->version, $path)
            ->sendPost();
    }
}