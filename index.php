<?php

include 'vendor/autoload.php';

use App\Tree;

$tree = new Tree;

function printTree($node, $indent, $prefix) {
    $indentStr = " ";

    $printStr = "";
    for ($i=0; $i < $indent; $i++) {
        $printStr = $printStr . $indentStr;
    }
    echo $printStr .  $prefix . " value: " . $node->data . "\n";
    $indent++;
    if ($node->left) {
        printTree($node->left, $indent, "left: ");
    }
    if ($node->right) {
        printTree($node->right, $indent, "right: ");
    }
}

$tree->insert(10);

printTree($tree->root, 0, "root");
echo "--------- \n";
$tree->insert(10);

printTree($tree->root, 0, "root");
echo "--------- \n";
$tree->insert(8);

printTree($tree->root, 0, "root");
echo "--------- \n";
$tree->insert(7);

printTree($tree->root, 0, "root");
echo "--------- \n";
$tree->insert(6);
printTree($tree->root, 0, "root");
echo "--------- \n";
$tree->insert(4);


printTree($tree->root, 0, "root");
