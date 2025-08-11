<?php
namespace App\Models;

use App\Models\Tenant;
use App\Models\Building;
use App\Models\Property;
use App\Models\TenancyPeriod;

abstract class Node
{
    public array $children = []; //array of nodes
    public $id;
    public $name;
    public $parent; 
    //Note: I have not setup an enum type for this, due to it already is a part of the class names. 

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function height()
    {
        if ($this === null) {
            return 0; //root
        }

        $maxChildHeight = 0;
        foreach ($this->children as $child) {
            $childHeight = $child->height();
            if ($childHeight > $maxChildHeight) {
                $maxChildHeight = $childHeight;
            }
        }
        return 1 + $maxChildHeight;
    }

    public function changeParent(Node $newParent)
    {
        // Remove from current parent, if any
        if ($this->parent !== null) {
            $this->parent->removeChild($this);
        }
        // Set new parent
        $newParent->addChild($this);
    }

    // Remove a child by node reference
    public function removeChild(Node $child)
    {
        foreach ($this->children as $key => $c) {
            if ($c === $child) {
                unset($this->children[$key]);
                // Reindex array
                $this->children = array_values($this->children);
                $child->parent = null;
                return true;
            }
        }
        return false;
    }

    public function addChild(Node $node)
    {
        //This is the place to setup conditions and validation
        if ($this->validate($node)) {
            $this->children[] = $node;
            $node->parent = $this; //the referenced model is the parent 
            return;
        }
        die;
    }

    /**
     * 
     * Properties can only have Buildings as parents.
     * Tenancy Periods can only have Properties as parents.
     * Tenants can only have Tenancy Periods as parents.
     * Only one Tenancy Period can be active in a Property at a time.
     * A Tenancy Period can have a maximum of 4 tenants at any time.
     * 
     * Usually you would implement a validation class that returns exceptions, but for simplicity I have left that out
     */
    public function validate($value)
    {
        if (get_class($value) === Building::class && $this === null) {
            //This is in order to skips the validations, since buildings does not have any requirements. 
            //From the task, it did not mention that Buildings could be not dependent on Coorporations
            return true;
        }

        if (get_class($value) === Property::class && get_class($this) !== Building::class) {
            echo "parent must be a building";
            return false;
        }
        if (get_class($value) === TenancyPeriod::class && get_class($this) !== Property::class) {
            echo "parent must be a Property";

            return false;
        }
        if (get_class($value) === Tenant::class && get_class($this) !== TenancyPeriod::class) {
            echo "parent must be a TenancyPeriod";

            return false;
        }
        if (get_class($value) === TenancyPeriod::class && get_class($this) === Property::class) {
            if (count($this->children) >= 4) {
                echo "Max children must be 4";

                return false; //because maximum 4 
            }
            //its siblings (tanancty periods) should not be active
            foreach ($this->children as $sibling) {
                if (get_class($sibling) === TenancyPeriod::class && !$sibling->active) {
                    return true;
                } else {
                    //reference broken, or tenancy period(s) are active
                    echo "There is already an active tenancy period";

                    return false;
                }
            }
        }

        return true;
    }
}
