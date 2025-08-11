<?php
namespace App\Models;

use App\Models\Node;

class Property extends Node
{

    public float $monthlyRent; //how much is the rent 

    public function __construct(int $id, string $name, $monthlyRent)
    {
        parent::__construct($id, $name);
        $this->monthlyRent = $monthlyRent;
    }
}
