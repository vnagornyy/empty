<?php

namespace App\Models;

class Call
{
    public string $date;
    public int $duration;
    public CallPhone $phone;
    public CallIp $ip;

    public function __construct($date, $duration, CallPhone $phone, CallIp $ip)
    {
        $this->date = $date;
        $this->duration = $duration;
        $this->phone = $phone;
        $this->ip = $ip;
    }
}
