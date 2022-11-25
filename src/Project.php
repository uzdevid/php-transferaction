<?php

namespace uzdevid\transferaction\src;

use uzdevid\transferaction\Transferaction;

/**
 * @property Transferaction $base
 */
class Project {
    public $base;

    public function __construct($base) {
        $this->base = $base;
    }

    public function create($email, $password) {
        $curl = curl_init();

        $url = "{$this->base->baseUrl}/{$this->base->version}/project/create";
        $raw = ["project" => ["email" => $email, 'password' => $password]];

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($raw, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->base->headers());
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    public function auth($email, $password) {
        $curl = curl_init();

        $url = "{$this->base->baseUrl}/{$this->base->version}/project/auth";
        $raw = ["project" => ["email" => $email, 'password' => $password]];

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($raw, JSON_UNESCAPED_UNICODE));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->base->headers());
        $response = curl_exec($curl);
        curl_close($curl);
        
        return json_decode($response, true);
    }

    public function data() {
        $curl = curl_init();

        $url = "{$this->base->baseUrl}/{$this->base->version}/project/view";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->base->headers());
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}