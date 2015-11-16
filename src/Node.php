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

}
