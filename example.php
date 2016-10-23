<?php
include 'text2Array.php';

$text = '
一个书单
    《浪潮之巅》
    《设计心理学》
    《启示录》
';

$t2a = new text2Array();
$array = $t2a->getArray($text);
var_dump($array);
