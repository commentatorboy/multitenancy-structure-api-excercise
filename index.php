<?php
require 'Tree.php';
require 'Building.php';
require 'TenancyPeriod.php';
require 'Property.php';

$tree = new Tree();
$building = new Building(1, "building a", "2900");
$buildingb = new Building(2, "building b", "3000");
$tree->add($building);
$tree->add($buildingb);

//this will fail due to contraints
//$period = new TenancyPeriod(1, [], "period a");
//$tree->add($period);

$property = new Property(1, "property a", 1000);
$propertyb = new Property(1, "property b", 2000);

$building->addChild($property);
$building->addChild($propertyb);

//var_dump($building->height());

//change the parent
$propertyb->changeParent($buildingb);

//var_dump($building->children);

//var_dump($buildingb->children);
