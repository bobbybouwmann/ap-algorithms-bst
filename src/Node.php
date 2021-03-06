<?php

namespace App;

class Node
{
    /**
     * The level of the node.
     *
     * @var int
     */
    public $level = 0;

    /**
     * The data of the node.
     *
     * @var null
     */
    public $data = null;

    /**
     * The left child node.
     *
     * @var null
     */
    public $left = null;

    /**
     * The right child node.
     *
     * @var null
     */
    public $right = null;

    public $value = 0;

    /**
     * Create the Node with the given data.
     *
     * @param null $data
     */
    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * Insert a new node.
     *
     * @param $node
     */
    public function insert($node)
    {
        if ($node->data < $this->data) {
            if ($this->left !== null) {
                $this->left->insert($node);
            } else {
                $this->left = $node;
            }
        } else {
            if ($this->right !== null) {
                $this->right->insert($node);
            } else {
                $this->right = $node;
            }
        }
        $this->balance();
    }

    public function balance() {
        $value = $this->getBalancedValue();

        if ($value > 1) {
            if ($this->left->left !== null) {
                $this->rotateRight();
            } else {
                $this->left->rotateLeft();
                $this->rotateRight();
            }

        } else if ($value < -1) {
            if ($this->right->right !== null) {
                $this->rotateLeft();
            } else {
                $this->right->rotateRight();
                $this->rotateLeft();
            }
        }
    }

    public function rotateLeft() {
        // copy our node
        $ownCopyNode = new Node($this->data);

        // Set the references to potential child nodes correctly
        $ownCopyNode->right = $this->right->left;
        $ownCopyNode->left = $this->left;

        // Make us our left node, so we have rotated left
        $this->data = $this->right->data;
        $this->right = $this->right->right;
        $this->left = $ownCopyNode;
    }

    public function rotateRight() {
        // copy our node
        $ownCopyNode = new Node($this->data);

        // Set the references to potential child nodes correctly
        $ownCopyNode->left = $this->left->right;
        $ownCopyNode->right = $this->right;

        // Make us our left node, so we have rotated left
        $this->data = $this->left->data;
        $this->left = $this->left->left;
        $this->right = $ownCopyNode;
    }

    /**
     * Delete a node based on the given data.
     *
     * @param $data
     *
     * @return bool
     */
    public function delete($data)
    {
        // element is in the left tree
        if ($data < $this->data) {
            if ($this->left !== null) {
                // delete from left tree
                $res = $this->left->delete($data);

                // our left element needs to be removed
                if ($res && $this->left->right === null && $this->left->left === null) {
                    $this->left = null;
                }
            }

            return false;
        } else { // element is either this node or in our right tree
            if ($this->data === $data) { // we have found our node to delete.
                if ($this->left !== null) {
                    $leftElement = $this->left;

                    // replace our data
                    $this->data = $leftElement->data;

                    // keep our left value
                    $tempRight = $this->right;

                    // Move our right element children to our left and right
                    $this->left = $leftElement->left;
                    $this->right = $leftElement->right;

                    if ($tempRight !== null) {
                        // Place the left child in our new tree
                        $this->insert($tempRight);
                    }
                } elseif ($this->right !== null) {
                    // We know that the right element is not present. So we just replace our current data by left
                    $elementToMoveUp = $this->right;

                    // replace our data
                    $this->data = $elementToMoveUp->data;

                    // Move our left element children to our left and right
                    $this->left = $elementToMoveUp->left;
                    $this->right = $elementToMoveUp->right;
                } else {
                    return true;
                }
            } else {
                if ($this->right !== null) {
                    // delete from right tree
                    $res = $this->right->delete($data);
                    if ($res && $this->right->right === null && $this->right->left === null) {
                        $this->right = null;
                    }
                }

                return false;
            }
        }
    }

    /**
     * Search through the tree for a certain Node with the correct data.
     *
     * @param $data
     *
     * @return $this|null
     */
    public function search($data)
    {
        if ($data < $this->data) { // element is in the left tree
            return $this->left !== null ? $this->left->search($data) : null;
        } else { // element is either this node or in our right tree
            if ($this->data === $data) { // we have found our node.
                return $this;
            } else {
                return $this->right !== null ? $this->right->search($data) : null;
            }
        }
    }

    private function getBalancedValue()
    {
        $value = 0;

        $nodeComp = $this->left;
        while ($nodeComp !== null) {
            $value++;
            $nodeComp = $nodeComp->left ? $nodeComp->left : $nodeComp->right;
        }

        $nodeComp = $this->right;
        while ($nodeComp !== null) {
            $value--;
            $nodeComp = $nodeComp->left ? $nodeComp->left : $nodeComp->right;
        }
        return $value;
    }
}
