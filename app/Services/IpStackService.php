<?php

namespace App\Services;

use GuzzleHttp\Client;

class IpStackService
{
    static array $ips = [];
    protected string $url = 'http://api.ipstack.com/%s';

    /**
     * @var mixed
     */
    protected $token;

    public function __construct()
    {
        $this->token = $_ENV['IPSTACK_API_KEY'];
    }

    public function getInfoIp(string $ip): IpStackModel
    {
        $response = $this->request($ip);
        if (isset($response['error'])) {
            throw new \Exception($response['error']['info'], $response['error']['code']);
        }
        return new IpStackModel($response);
    }

    public function request(string $data): array
    {
        $client = new Client();
        $response = $client->get(sprintf($this->url, $data), [ 'query' => [ 'access_key' => $this->token ] ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getInfoManyIp(array $allIps): array
    {
        $response = $this->request(implode(',', $allIps));
        if (isset($response['error'])) {
            throw new \Exception($response['error']['info'], $response['error']['code']);
        }
        $data = [];

        foreach ($response as $item) {
            $data[] = new IpStackModel($item);
        }

        return $data;
    }


    /**
     * @throws \Exception
     */
    public function getInfoManyIpSimple(array $allIps): array
    {
        $data = [];
        foreach ($allIps as $ip) {
            if (isset(self::$ips[$ip])) {
                $data[$ip] = self::$ips[$ip];
            } else {
                $response = $this->getInfoIp($ip);
                $data[$ip] = $response;
                self::$ips[$ip] = $response;
            }
        }
        return $data;
    }
}
