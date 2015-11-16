<?php

namespace App;

class Tree {

	private $root = null;

	private $count = 0;

	public function insert($data = null)
	{
		$node = new Node($data);

		// Check if this is the first node, if so we set the first node
		if ( $this->root === null) {
			$this->root = &$node;

		// Else create a new node under the root
		} else {
			$current = $this->root;

			if ($data < $current->data) {
				$node->level++;

				if ($current->left !== null) {
					$current->left->insert($node);
				} else {
					$current->left = $node;
				}
			} else {
				if ($current->right !== null) {
					$current->right->insert($node);
				} else {
					$current->right = $node;
				}
			}
		}
		$this->count++;
	}

	public function delete($data = null)
	{
		$direction = null;
		$parent = null;
		$current = $this->root;

		while ($current !== null) {

			// Check if we need to go left
			if ($data < $current->data) {
				if ($current->left !== null) {
					$parent = $current;
					$direction = 'left';
					$current = $current->left;
				} else {
					return false;
				}

			// Check if we need to go right
			} else if ($data > $current->data) {
				if ($current->right !== null) {
					$parent = $current;
					$direction = 'right';
					$current = $current->right;
				} else {
					return false;
				}

			// Delete the element
			} else {
				if ($current->left === null && $current->right === null) {
					if ($parent !== null && $direction !== null) {
						$parent->$direction = null;
					} else {
						$this->root = null;
					}
				} else if ($current->right !== null && ($current->left === null || $current->right->left === null)) {
					if ($parent !== null && $direction !== null) {
						$parent->$direction = $current->right;
					} else {
						$this->root = $current->right;
					}
				} else {
					$current->data = $this->popMostLeftNode($current->right);
				}

				$this->count--;

				return true;
			}
		}
	}

	/**
	 * Search for the node based on the given data
	 *
	 * @param  $data
	 * @return Node
	 */
	public function search($data = null)
	{
		$current = $this->root;

		while ($current !== null) {

			// Check if we need to go the left
			if ($data < $current->data) {
				if ($current->left != null) {
					$current = $current->left;
				} else {
					return null;
				}

			// Check if we need to go the right
			} else if ($data > $current->data) {
				if ($current->right !== null) {
					$current = $current->right;
				} else {
					return null;
				}

			// Return the current position
			} else {
				return $current;
			}
		}
	}

	public function count()
	{
		return $this->count;
	}

	private function popMostLeftNode(&$node) {
		$parent = null;
		$current = $node;

		while ($current->left !== null) {
			$parent = $current;
			$current = $current->left;
		}

		$parent->left = nul;
		$data = $current->data;

		return $data;
	}

}
