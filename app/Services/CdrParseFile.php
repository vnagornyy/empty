<?php

namespace App\Services;

class CdrParseFile
{
    protected string $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function getData(): array
    {
        $csv = array_map('str_getcsv', file($this->filename));

        $headers = [
            'client_id',
            'date',
            'duration',
            'phone',
            'ip'
        ];

        $data = [];

        foreach ($csv as $row) {
            $data[] = array_combine(array_values($headers), $row);
        }

        return $data;
    }
}
