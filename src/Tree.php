<?php

namespace App;

class Tree
{
    /**
     * The beginning (root) of the tree.
     *
     * @var null
     */
    public $root = null;

    /**
     * Insert a new Node in the tree.
     * If the $root is null we create a new root node.
     *
     * @param null $data
     */
    public function insert($data = null)
    {
        $node = new Node($data);

        // Check if this is the first node, if so we set the first node
        if ($this->root === null) {
            $this->root = &$node;
            // Else create a new node under the root
        } else {
            $this->root->insert($node);
        }
    }

    /**
     * Delete the Node which contains the given data from the tree.
     *
     * @param null $data
     */
    public function delete($data = null)
    {
        if ($this->root !== null && $this->root->delete($data)) {
            $this->root = null;
        }
    }

    /**
     * Search in the tree for the given data.
     *
     * @param null $data
     *
     * @return null
     */
    public function search($data = null)
    {
        return $this->root !== null ? $this->root->search($data) : null;
    }
}
