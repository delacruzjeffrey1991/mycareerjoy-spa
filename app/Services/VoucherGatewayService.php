<?php

namespace App\Services;

use App\AccessToken;
use \GuzzleHttp\Client;

class VoucherGatewayService
{

    private $api_url;
    private $client_system_uuid;
    private $auth_client_id;
    private $auth_client_secret;
    private $auth_username;
    private $auth_password;
    private $client;
    private $headers;
    private $client_options = [];

    public function __construct()
    {
        $this->api_url = config('vouchergateway.api_url');
        $this->client_system_uuid = config('vouchergateway.client.uuid');
        $this->auth_client_id = config('vouchergateway.client.id');
        $this->auth_client_secret = config('vouchergatewayclient.secret');
        $this->auth_username = config('vouchergateway.client.username');
        $this->auth_password = config('vouchergateway.client.password');
        $this->client = new Client(['base_uri' => $this->api_url]);

        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorzation' => 'Bearer ' . session('gateway_token')
        ];

        $token = $this->fetchToken();

        if (!$token) {
            $this->authenticate();
        }
    }

    public function createProgram($program)
    {
        $uri = $this->api_url . '/programs';
        $options = [
            'headers' => $this->headers,
            'form_params' => $program,
        ];

        $program = $this->send($uri, $options);
    }

    public function updateProgram($id, $program)
    {
        $uri = $this->api_url . '/programs/' . $id;
        $options = [
            'headers' => $this->headers,
            'form_params' => $program,
        ];

        $program = $this->send($uri, $options);
    }

    public function getBranches()
    {
        $uri = $this->api_url . '/branches';
        $options = ['headers' => $this->headers];

        $branches = $this->send($uri, $options);

        return $branches;
    }

    public function createVoucher($voucher)
    {
        $uri = $this->api_url . '/vouchers';
        $options = [
            'headers' => $this->headers,
            'form_params' => $voucher,
        ];

        $voucher = $this->send($uri, $options);

        return $voucher;
    }

    public function updateVoucher($id, $voucher)
    {
        $uri = $this->api_url . '/vouchers/' . $id;
        $options = [
            'headers' => $this->headers,
            'form_params' => $voucher,
        ];

        $voucher = $this->send($uri, $options);

        return $voucher;
    }

    public function createDenomination($denomination)
    {
        $uri = $this->api_url . '/denominations';
        $options = [
            'headers' => $this->headers,
            'form_params' => $denomination,
        ];

        $denomination = $this->send($uri, $options);

        return $denomination;
    }

    public function updateDenomination($id, $denomination)
    {
        $uri = $this->api_url . '/denominations/' . $id;
        $options = [
            'headers' => $this->headers,
            'form_params' => $denomination,
        ];

        $denomination = $this->send($uri, $options);

        return $denomination;
    }

    public function batchCreate($batch)
    {
        $uri = $this->api_url . '/batches';
        $options = [
            'headers' => $this->headers,
            'form_params' => $batch,
        ];

        $batch = $this->send($uri, $options);

        return $batch;
    }

    public function batchUpdate($id, $batch)
    {
        $uri = $this->api_url . '/batches/' . $id;
        $options = [
            'headers' => $this->headers,
            'form_params' => $batch,
        ];

        $batch = $this->send($uri, $options);

        return $batch;
    }

    public function batchGenerate($batch_id)
    {
        $uri = $this->api_url . '/vouchers/batch-generate';
        $options = [
            'headers' => $this->headers,
            'form_params' => ['batch_id' => $batch_id],
        ];

        $codes = $this->send($uri, $options);

        return $codes;
    }

    private function authenticate()
    {
        $uri =  $this->api_url . 'oauth/token';
        $options = [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => $this->auth_client_id,
                'client_secret' => $this->auth_client_secret,
                'username'      => $this->auth_username,
                'password'      => $this->auth_password
            ]
        ];

        $authorization = $this->send($uri, $options);

        AccessToken::create([
            'token' => $authorization['access_token'],
            'expiration' => $authorization['expiry_date']
        ]);

        if ($authorization) {
            session([
                'access_token' => $authorization['access_token'],
                'expiration' => $authorization['expiry_date']
            ]);
        }
    }

    private function send($uri, $options)
    {
        $response = $this->client->request('POST', $uri, $options);

        return $response;
    }

    private function fetchToken()
    {
        $token = AccessToken::max('id');

        if ($token) {
            session([
                'access_token' => $token->token,
                'expiration' => $token->expiration
            ]);

            return true;
        }

        return false;
    }
}
