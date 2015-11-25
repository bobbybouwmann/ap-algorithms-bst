<?php

use App\Tree;

class TreeTest extends PHPUnit_Framework_TestCase {

	public function testInsertOneValue()
	{
		$tree = new Tree();

		$tree->insert($value = 12);

		$this->assertEquals($value, $tree->root->data);
	}

	public function testTreeWithOneLeave()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 8);

		$this->assertEquals($valueOne, $tree->root->data);
		$this->assertEquals($valueTwo, $tree->root->left->data);
	}

	public function testTreeWithTwoLeavesLeftRight()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 8);
		$tree->insert($valueThree = 23);

		$this->assertEquals($valueOne, $tree->root->data);
		$this->assertEquals($valueTwo, $tree->root->left->data);
		$this->assertEquals($valueThree, $tree->root->right->data);
	}

	public function testTreeWithTwoLeavesRightLeft()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 2);
		$tree->insert($valueTwo = 3);
		$tree->insert($valueThree = 1);

		$this->assertEquals($valueOne, $tree->root->data);
		$this->assertEquals($valueTwo, $tree->root->right->data);
		$this->assertEquals($valueThree, $tree->root->left->data);
	}

	public function testTreeWithTwoLeavesLeft()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 8);
		$tree->insert($valueThree = 4);

		$this->assertEquals($valueTwo, $tree->root->data);
		$this->assertEquals($valueThree, $tree->root->left->data);
		$this->assertEquals($valueOne, $tree->root->right->data);
	}

	public function testTreeWithTwoLeavesRight()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 24);
		$tree->insert($valueThree = 48);

		$this->assertEquals($valueTwo, $tree->root->data);
		$this->assertEquals($valueThree, $tree->root->right->data);
		$this->assertEquals($valueOne, $tree->root->left->data);
	}

	public function testThreeWithThreeLeavesRightRightLeft()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 24);
		$tree->insert($valueThree = 48);
		$tree->insert($valueFour = 18);

		$this->assertEquals($valueTwo, $tree->root->data);
		$this->assertEquals($valueThree, $tree->root->right->data);
		$this->assertEquals($valueOne, $tree->root->left->data);
		$this->assertEquals($valueFour, $tree->root->left->right->data);
	}

	public function testThreeWithThreeLeavesLeftLeftRight()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 8);
		$tree->insert($valueThree = 4);
		$tree->insert($valueFour = 10);

		$this->assertEquals($valueTwo, $tree->root->data);
		$this->assertEquals($valueThree, $tree->root->left->data);
		$this->assertEquals($valueOne, $tree->root->right->data);
		$this->assertEquals($valueFour, $tree->root->right->left->data);
	}

	public function testThreeWithSomeBigNumbers()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 8);
		$tree->insert($valueThree = 4);
		$tree->insert($valueFour = 18);

		$this->assertEquals($valueTwo, $tree->root->data);
		$this->assertEquals($valueThree, $tree->root->left->data);
		$this->assertEquals($valueOne, $tree->root->right->data);
		$this->assertEquals($valueFour, $tree->root->right->right->data);
	}

	public function testDeleteRootNode()
	{
		$tree = new Tree();

		$tree->insert($value = 12);

		$tree->delete($value);

		$this->assertNull($tree->root);
	}

	public function testDeleteLeftNode()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 8);

		$tree->delete($valueTwo);

		$this->assertEquals($valueOne, $tree->root->data);
		$this->assertNull($tree->root->left);
	}


	public function testDeleteRightNode()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 24);

		$tree->delete($valueTwo);

		$this->assertEquals($valueOne, $tree->root->data);
		$this->assertNull($tree->root->right);
	}

	public function testDeleteLeftLeftNode()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 8);
		$tree->insert($valueThree = 4);

		$tree->delete($valueThree);

		$this->assertEquals($valueTwo, $tree->root->data);
		$this->assertEquals($valueOne, $tree->root->right->data);
		$this->assertNull($tree->root->left);
	}

	public function testDeleteRightRightNode()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 18);
		$tree->insert($valueThree = 24);

		$tree->delete($valueThree);

		$this->assertEquals($valueTwo, $tree->root->data);
		$this->assertEquals($valueOne, $tree->root->left->data);
		$this->assertNull($tree->root->right);
	}

	public function testDeleteNodeWithSingleLeaves()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 18);
		$tree->insert($valueThree = 24);
		$tree->insert($valueFour = 21);

		$tree->delete($valueTwo);

		$this->assertEquals($valueThree, $tree->root->data);
		$this->assertEquals($valueOne, $tree->root->left->data);
		$this->assertEquals($valueFour, $tree->root->right->data);
	}


	public function testDeleteNodeWithMultipleLeaves()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 18);
		$tree->insert($valueThree = 24);
		$tree->insert($valueFour = 16);
		$tree->insert($valueFive = 22);
		$tree->insert($valueSix = 28);

		$tree->delete($valueTwo);

		$this->assertEquals($valueThree, $tree->root->data);
		$this->assertEquals($valueOne, $tree->root->left->data);
		$this->assertEquals($valueFour, $tree->root->left->right->data);
        $this->assertEquals($valueSix, $tree->root->right->data);
        $this->assertEquals($valueFive, $tree->root->right->left->data);
	}

	public function testSimpleSearch()
	{
		$tree = new Tree();

		$tree->insert($value = 12);

		$this->assertEquals($tree->search($value), $tree->root);
	}

	public function testSearchThroughLeaves()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 24);
		$tree->insert($valueThree = 6);

		$this->assertEquals($tree->search($valueOne), $tree->root);
		$this->assertEquals($tree->search($valueTwo), $tree->root->right);
		$this->assertEquals($tree->search($valueThree), $tree->root->left);
	}

	public function testSearchThroughLotsOfLeaves()
	{
		$tree = new Tree();

		$tree->insert($valueOne = 12);
		$tree->insert($valueTwo = 18);
		$tree->insert($valueThree = 24);
		$tree->insert($valueFour = 16);
		$tree->insert($valueFive = 22);
		$tree->insert($valueSix = 28);

		$this->assertEquals($tree->search($valueThree), $tree->root);
		$this->assertEquals($tree->search($valueSix), $tree->root->right);
		$this->assertEquals($tree->search($valueTwo), $tree->root->left);
		$this->assertEquals($tree->search($valueOne), $tree->root->left->left);
        $this->assertEquals($tree->search($valueFive), $tree->root->left->right);
		$this->assertEquals($tree->search($valueFour), $tree->root->left->left->right);
		$this->assertEquals($valueOne, $tree->search($valueTwo)->left->data);
	}

}
