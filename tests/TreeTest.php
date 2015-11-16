<?php 

use App\Tree;

class TreeTest extends PHPUnit_Framework_TestCase {

	public function testInsertOneValue()
	{
		$tree = new Tree();
		
		$tree->insert($value = 12);

		$this->assertEquals($tree->root->data, $value);
	}

}
