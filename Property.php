<?php

class Property extends Node{

    public float $monthlyRent; //how much is the rent 

    //Properties can only have Buildings as parents.
    //Only one Tenancy Period can be active in a Property at a time.
}