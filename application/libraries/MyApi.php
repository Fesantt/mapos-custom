<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyApi {

    protected $ci;
    protected $endpoint;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->endpoint = 'https://botzapapi.anotando.online/api/messages/send';
    }

    public function callApi($data)
    {
        $url = $this->endpoint;
        $authorization = '123456';

        $headers = [
            'Authorization: Bearer ' . $authorization,
            'Content-Type: application/json',
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if ($response === FALSE) {
            die(curl_error($ch));
        }

        curl_close($ch);

        return $response;
    }
}
