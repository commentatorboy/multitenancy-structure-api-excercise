<?php 
require 'Tree.php';

require 'Building.php';

$tree = new Tree();
$building = new Building(1, null);
$tree->add($building);

var_dump($tree);

