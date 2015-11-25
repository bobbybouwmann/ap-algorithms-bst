<?php

namespace App;

class Node
{
    /**
     * The level of the node.
     *
     * @var int
     */
    public $level = 1;

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
            $this->value++;
            if ($this->left !== null) {
                $this->left->insert($node);
            } else {
                $this->left = $node;
            }
        } else {
            $this->value--;
            if ($this->right !== null) {
                $this->right->insert($node);
            } else {
                $this->right = $node;
            }
        }

        if ($this->getBalancedValue() >= 2) { // if difference is >= 2 we want to balance our tree
            // balancing our tree is getting our left child and putting it on our place
            // and we put our current node to our right place.

            $ownCopyNode = new Node($this->data);

            if ($this->right !== null) {
                $ownCopyNode->insert($this->right);
            }

            $this->right = $ownCopyNode; // we replaced our right and we moved us one down

            $copyLeftValue = $this->left->data; // temp store our left value, because we are removing that node
            // get rid of our left value
            $this->delete($this->left->data);

            $this->data = $copyLeftValue; // replace the current node by our temp left value.
            $this->value--; // we balanced our tree

        } else if ($this->getBalancedValue() <= -2) {
            $ownCopyNode = new Node($this->data);

            if ($this->left !== null) {
                $ownCopyNode->insert($this->left);
            }

            $this->left = $ownCopyNode; // we replaced our left and we moved us one down

            $copyRightValue = $this->right->data; // temp store our left value, because we are removing that node
            // get rid of our left value
            $this->delete($this->right->data);

            $this->data = $copyRightValue; // replace the current node by our temp left value.
            $this->value++; // we balanced our tree
        }
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
                $this->value--;
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
                    $this->value++;
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

    protected function getBalancedValue()
    {
        $value = $this->value;

        if ($this->left) {
            $value += $this->left->value;
        }

        if ($this->right) {
            $value += $this->right->value;
        }

        return $value;
    }
}
