<?php 

include 'vendor/autoload.php';

use App\Tree;

$tree = new Tree;

$tree->insert(12);
$tree->insert(10);
$tree->insert(8);
$tree->insert(24);
$tree->delete(8);