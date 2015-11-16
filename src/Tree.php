<?php

namespace App;

class Tree {

	public $root = null;

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
	}

	public function delete($data = null)
	{
		if ($this->root !== null && ($this->root->delete($data))) {
				$this->root = null;
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
		return $this->root !== null ? $this->root->search($data) : null;
	}

}
