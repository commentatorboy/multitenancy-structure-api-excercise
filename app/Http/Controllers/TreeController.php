<?php

namespace App\Http\Controllers;


use App\Models\Tree;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Building;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\TenancyPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Requests\Settings\ProfileUpdateRequest;

class TreeController
{
    public function get(){
        $tree = new Tree();
        $building = new Building(1, "building a", "2900");
        $buildingb = new Building(2, "building b", "3000");
        $tree->add($building);
        $tree->add($buildingb);
    
        //this will fail due to contraints
        //$period = new TenancyPeriod(1, "period a", true);
        //$building->addChild($period);
    
        $property = new Property(1, "property a", 1000);
        $propertyb = new Property(2, "property b", 2000); 
    
        $building->addChild($property);
        $building->addChild($propertyb);
    
        dump($building->height());
    
        //change the parent
        $propertyb->changeParent($buildingb);
    
        dump($building->children);
    
        dd($buildingb->children);
    }


}
