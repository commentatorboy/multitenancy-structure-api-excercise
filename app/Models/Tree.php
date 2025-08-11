<?php

require 'Node.php';
require 'Corporation.php';

class Tree
{
    private ?Node $root = null; //Corporation

    public function isEmpty()
    {
        return $this->root == null;
    }

    public function clear()
    {
        $this->root = null;
    }

    public function add(Node $node)
    {
        if ($this->root == null) {
            $this->root = new Corporation(1, "Corporation");
            return;
        }
        $this->root->addChild($node);
    }
}
