<?php

namespace App\Models;

class Customer
{
    public int $id;
    /**
     * @var Call[]
     */
    protected array $calls = [];

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function setCalls($calls)
    {
        $this->calls = $calls;
    }

    protected function callSameContinent(): \Tightenco\Collect\Support\Collection
    {
        return collect($this->calls)->filter(function (Call $item) {
            if (is_null($item->phone->continent) || is_null($item->ip->continent)) {
                return false;
            }
            return $item->phone->continent === $item->ip->continent;
        });
    }

    public function getAllCalls(): int
    {
        return count($this->calls);
    }

    public function getTotalDuration()
    {
        return collect($this->calls)->sum('duration');
    }

    public function getCallsCountSameContinent(): int
    {
        return $this->callSameContinent()->count();
    }

    public function getCallsDurationSameContinent(): int
    {
        return $this->callSameContinent()->sum('duration');
    }
}
