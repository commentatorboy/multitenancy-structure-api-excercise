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

    // Clear out the BST.
    public function clear()
    {
        $this->root = null;
    }

    public function add(Node $value)
    {
        if ($this->root == null) {
            $this->root = new Corporation($value, null);
            return;
        }
        $this->root->addChild($value, null);
    }

    // Convert the tree to a string.
    public function __toString()
    {
        $res = "{ " . $this->toStringAux($this->root) . "}";
        return $res;
    }

    // Helper method for the toString function.
    private function toStringAux($treeNode)
    {
        $res = "";

        if (!$treeNode) {
            return "";
        }

        if ($treeNode->left != null) {
            $res = $res . $this->toStringAux($treeNode->left);
        }
        $res .= (string) $treeNode->value . " ";
        if ($treeNode->right != null) {
            $res .= $this->toStringAux($treeNode->right);
        }

        return $res;
    }
}
