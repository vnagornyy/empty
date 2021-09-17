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
        return collect($this->calls)->filter(function (Call $item) {
            if (is_null($item->phone->continent) || is_null($item->ip->continent)) {
                return false;
            }
            return $item->phone->continent === $item->ip->continent;
        })->count();
    }

    public function getCallsSameContinent(): int
    {
        return collect($this->calls)->filter(function (Call $item) {
            if (is_null($item->phone->continent) || is_null($item->ip->continent)) {
                return false;
            }
            return $item->phone->continent === $item->ip->continent;
        })->count();
    }

    public function getCallsDurationSameContinent(): int
    {
        return collect($this->calls)->filter(function (Call $item) {
            return $item->phone->continent === $item->ip->continent;
        })->sum('duration');
    }
}
