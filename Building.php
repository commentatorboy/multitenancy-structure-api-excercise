<?php

class Building extends Node
{

    public string $zipcode;

    public function __construct(int $id, string $name, string $zipcode)
    {
        parent::__construct($id, $name);
        $this->zipcode = $zipcode;
    }
}
