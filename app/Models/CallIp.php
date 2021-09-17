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
        if ($ip === '37.35.105.218') {
            $this->continent = 'AF';//dd($ipStackModel);
        }
    }
}
