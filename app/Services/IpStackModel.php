<?php

namespace App\Services;

class IpStackModel
{
    protected array $data;

    /**
     * IpStackModel constructor.
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getContinentCode()
    {
        return $this->data['continent_code'] ?? null;
    }
}
