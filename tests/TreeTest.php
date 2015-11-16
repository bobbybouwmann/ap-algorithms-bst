<?php 

use App\Node;

class TreeTest extends PHPUnit_Framework_TestCase {

	public function testInsertOneValue()
	{
		$tree = new Tree();
		
		$tree->insert($value = 12);

		$this->assertEqual($tree->root->data, $value);
	}

}
