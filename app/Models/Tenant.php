<?php

class Tenant extends Node
{

    public $movedInDate;

    public function __construct(int $id, string $name, $movedInDate)
    {
        parent::__construct($id, $name);
        $this->movedInDate = $movedInDate;
    }
}
