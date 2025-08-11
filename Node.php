<?php
abstract class Node
{
    public $value;
    public array $children; //array of nodes
    public $id;
    public $name;
    public $parent;
    public $type; //Corporation, Building, Property, Tenancy Period, Tenant.

    public function __construct($value, $child)
    {
        $this->value = $value;
        $this->children[] = $child;
    }

    public function height($node)
    {
        if ($node === null) {
            return 0; //root
        }

        $leftTreeHeight = $this->height($node->left);
        $rightTreeHeight = $this->height($node->right);


        return max($leftTreeHeight, $rightTreeHeight) + 1;
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

    public function changeParent(Node $newParent)
    {
        // Remove from current parent, if any
        if ($this->parent !== null) {
            $this->parent->removeChild($this);
        }
        // Set new parent
        $newParent->addChild($this, $newParent);
    }

    private function addChild($value, $treeNode)
    {
        //This is the place to setup conditions and validation
        if($this->validate($value)){
            $treeNode->children[] = $value;
            $value->parent = $treeNode; //instead of $treenode it was $this...???
        }
        return;
    }

    /**
     * 
     * Properties can only have Buildings as parents.
     * Tenancy Periods can only have Properties as parents.
     * Tenants can only have Tenancy Periods as parents.
     * Only one Tenancy Period can be active in a Property at a time.
     * A Tenancy Period can have a maximum of 4 tenants at any time.
     * 
     */
    public function validate($value){
        if(get_class($value) === Building::class){
            return true; 
        }
        if(get_class($value) === Property::class && $value->parent !== Building::class){
            //parent must be a building
            return false; //Or just show error
        }
        if(get_class($value) === TenancyPeriod::class && $value->parent !== Property::class){
            //parent must be a Property

            if(count($value->parent->children) >= 4){
                return false; //because maximum 4 
            }
            //its siblings (tanancty periods) should not be active
            foreach($value->parent->children as $sibling){
                if(get_class($sibling) === TenancyPeriod::class && !$sibling->active){
                    return true;
                }
                else{
                    //reference broken, or tenancy period(s) are active
                    return false; //because there is one tenancy period that is active
                }
            }

            return false; 
        }
        if(get_class($value) === Tenant::class && $value->parent !== TenancyPeriod::class){
            //parent must be a TenancyPeriod
            return false; 
        }
        if(get_class($value) === Tenant::class && $value->parent !== TenancyPeriod::class){
            //parent must be a Property
            return false; 
        }

    }
}
