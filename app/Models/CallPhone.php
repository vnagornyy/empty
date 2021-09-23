<?php

namespace App\Models;

use App\Services\GeoName\CountryInfo;
use Brick\PhoneNumber\PhoneNumber;

class CallPhone
{
    public string $phone;
    public ?string $countryCode = null;
    public ?string $continent = null;

    /**
     * @throws \Brick\PhoneNumber\PhoneNumberParseException
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;
        $number = PhoneNumber::parse('+'.$phone);
        $this->countryCode = $number->getCountryCode();
        $this->continent = CountryInfo::getInstance()->getContinentByCountryCode($this->countryCode);
    }
}
