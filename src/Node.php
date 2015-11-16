<?php

namespace App;

class Node {

	public $level = 1;
	public $data = null;
	public $left = null;
	public $right = null;

	public function __construct($data = null)
	{
		$this->data = $data;
	}

	public function insert($node) {
		if ($node->data < $this->data) {
			$node->level++;
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
	}

	public function delete($data) {
		if ($data < $this->data) { // element is in the left tree
			if ($this->left !== null) {
				$this->left->delete($data);
			} else {
				return false; // element is not in the tree
			}
		} else { // element is either this node or in our right tree
			if ($this->data === $data) { // we have found our node to delete.
				if ($this->right !== null) {
					$rightElement = $this->right;

					$this->data = $rightElement->data; // replace our data
					$tempLeft = $this->left; // keep our left value

					// Move our right element childs to our left and right
					$this->left = $rightElement->left;
					$this->right = $rightElement->right;

					if ($tempLeft !== null) {
						// Place the left child in our new tree
						insert($tempLeft);
					}
					return true;
				}
			} else {
				if ($this->right !== null) {
					$this->right->delete($node); // delete from right tree
				} else {
					return false; // element is not in the tree
				}
			}
		}
	}
}
