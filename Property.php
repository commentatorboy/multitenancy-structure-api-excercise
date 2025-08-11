<?php

class Property extends Node
{

    public float $monthlyRent; //how much is the rent 

    public function __construct(int $id, string $name, $monthlyRent)
    {
        parent::__construct($id, $name);
        $this->monthlyRent = $monthlyRent;
    }
}
