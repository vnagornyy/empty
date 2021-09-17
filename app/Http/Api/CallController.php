<?php

namespace App\Http\Api;

use App\Services\CdrParseFile;

class CallController
{
    public function handler()
    {
        $data = (new CdrParseFile($_FILES['file']['tmp_name']))->getData();
        $service = new \App\Services\CallService($data);

        return json_encode([
            'data' => $service->generateData()
        ]);
    }
}
