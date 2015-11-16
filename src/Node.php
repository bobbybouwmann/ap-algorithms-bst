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

}