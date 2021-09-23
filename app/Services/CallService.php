<?php

namespace App\Services;

use App\Models\Call;
use App\Models\CallIp;
use App\Models\CallPhone;
use App\Models\Customer;

class CallService
{
    protected array $data;
    /**
     * @var IpStackService
     */
    protected IpStackService $ipStack;

    public function __construct(CdrParseFile $data)
    {
        $this->ipStack = new IpStackService();
        $this->data = $data->getData();
    }

    /**
     * @throws \Brick\PhoneNumber\PhoneNumberParseException
     */
    public function generateData(): array
    {
        $items = $this->data;

        $data = collect($items)->groupBy('client_id');
        $results = [];

        foreach ($data as $clientId => $calls) {
            $customer = new Customer($clientId);
            $ips = $calls->pluck('ip')->toArray();
            $ipsData = $this->ipStack->getInfoManyIpSimple($ips);

            $customerCalls = [];

            foreach ($calls as $call) {
                $ip = new CallIp($call['ip'], $ipsData[$call['ip']]);
                $phone = new CallPhone($call['phone']);
                $customerCalls[] = new Call($call['date'], $call['duration'], $phone, $ip);
            }

            $customer->setCalls($customerCalls);

            $results[] = [
                'customer_id' => $customer->id,
                'all_calls' => $customer->getAllCalls(),
                'calls_count_same_continent' => $customer->getCallsCountSameContinent(),
                'calls_duration_same_continent' => $customer->getCallsDurationSameContinent(),
                'total_duration' => $customer->getTotalDuration()
            ];
        }

        return $results;
    }
}
