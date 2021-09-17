<?php

namespace App\Services\GeoName;

class CountryInfo
{
    protected static $instance;
    protected static string $file = __DIR__.'/countryInfo.txt';
    protected array $data = [];

    public static function getInstance(): CountryInfo
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->generateData();
    }

    public function getContinentByCountryCode(string $code): ?string
    {
        return collect($this->data)->where('country_code', $code)->first()['continent'] ?? null;
    }

    protected function generateData()
    {
        $rows = array_map(function ($v) {
            return str_getcsv($v, "	");
        }, file(self::$file));
        array_shift($rows);
        $csv = [];
        foreach ($rows as $row) {
            $csv[] = [
                'country_code' => $row[0],
                'continent' => $row[8],
                'phone' => $row[12],
            ];
        }
        $this->data = $csv;
    }
}
