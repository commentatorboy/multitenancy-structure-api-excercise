<?php
namespace App\Models;

use App\Models\Node;

class TenancyPeriod extends Node
{
    //Tenancy Periods can only have Properties as parents.
    //Only one Tenancy Period can be active in a Property at a time.
    //A Tenancy Period can have a maximum of 4 tenants at any time.

    public bool $active;

    public function __construct(int $id, string $name, $active)
    {
        parent::__construct($id, $name);
        $this->active = $active;
    }
}
