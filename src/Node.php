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
				$res = $this->left->delete($data); // delete from left tree

				if ($res && $this->left->right === null && $this->left->left === null) {
					$this->left = null;
				}
				return false;
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
						$this->insert($tempLeft);
					}
					return true;
				} elseif ($this->left !== null) {
					// We know that the right element is not present. So we just replace our current data by left

					$elementToMoveUp = $this->left;
					$this->data = $elementToMoveUp->data; // replace our data

					// Move our left element childs to our left and right
					$this->left = $elementToMoveUp->left;
					$this->right = $elementToMoveUp->right;
				} else {
					// Both childs are null
					return true;
				}
			} else {
				if ($this->right !== null) {
					$res = $this->right->delete($data); // delete from right tree
					if ($res && $this->right->right === null && $this->right->left === null) {
						$this->right = null;
					}
					return false;

				} else {
					return false; // element is not in the tree
				}
			}
		}
	}
}
