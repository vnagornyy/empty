<?php

namespace App\Models;

use App\Services\IpStackModel;

class CallIp
{
    public string $ip;
    public ?string $continent = null;

    public function __construct(string $ip, ?IpStackModel $ipStackModel = null)
    {
        $this->ip = $ip;
        $this->continent = !is_null($ipStackModel) ? $ipStackModel->getContinentCode() : null;
    }
}
