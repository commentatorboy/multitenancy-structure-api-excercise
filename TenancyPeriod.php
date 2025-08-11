<?php

class TenancyPeriod extends Node{

    public bool $active;

    //Tenancy Periods can only have Properties as parents.
    //Only one Tenancy Period can be active in a Property at a time.
    //A Tenancy Period can have a maximum of 4 tenants at any time.
}