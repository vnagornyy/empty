<?php

namespace App\Models;

use App\Services\GeoName\CountryInfo;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberParseException;

class CallPhone
{
    public string $phone;
    public ?string $countryCode = null;
    public ?string $continent = null;

    /**
     * @throws PhoneNumberParseException
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;
        $number = PhoneNumber::parse('+'.$phone);
        $this->countryCode = $number->getRegionCode();
        if (!is_null($number->getRegionCode())) {
            $this->continent = CountryInfo::getInstance()->getContinentByCountryCode($number->getRegionCode());
        }
    }
}
