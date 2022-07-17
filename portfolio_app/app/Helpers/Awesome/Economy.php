<?php

namespace App\Helpers\Awesome;

class Economy {
    const BASE_URL = 'https://economia.awesomeapi.com.br/json';

    public function CotationConsult($coinA, $coinB) {
        return $this->get('/last/'.$coinA.'-'.$coinB);
    }

    public function get($resource) {
        $endpoint = self::BASE_URL.$resource;
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response, true);
    }
}