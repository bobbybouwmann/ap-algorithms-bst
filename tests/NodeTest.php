<?php

use App\Node;

class NodeTest extends PHPUnit_Framework_TestCase {

    public function testConstructor()
    {
        $node = new Node($value = 12);

        $this->assertEquals($node->data, $value);
        $this->assertEquals($node->level, 0);
        $this->assertNull($node->left);
        $this->assertNull($node->right);
    }

}
