<?php

namespace App\Http\Api;

use App\Services\CallService;
use App\Services\CdrParseFile;
use Brick\PhoneNumber\PhoneNumberParseException;

class CallController
{
    /**
     * @throws PhoneNumberParseException
     */
    public function handler()
    {
        $data = new CdrParseFile($_FILES['file']['tmp_name']);
        $service = new CallService($data);

        return json_encode([
            'data' => $service->generateData()
        ]);
    }
}
