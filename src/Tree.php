<?php

namespace App;

class Tree {

	public $root = null;

	public $count = 0;

	public function insert($data = null)
	{
		$node = new Node($data);

		// Check if this is the first node, if so we set the first node
		if ( $this->root === null) {
			$this->root = &$node;
		// Else create a new node under the root
		} else {
			$this->root->insert($node);
		}
		$this->count++;
	}

	public function delete($data = null)
	{
		if ($this->root !== null && ($this->root->delete($data))) {
				$this->count--;
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
