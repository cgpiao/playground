<?php
$a = 10;
$b = 15;
$c = 20;
$numbers = [100, 150, 200];
list($a) = $numbers;
echo $a . PHP_EOL; // 100
[1 => &$b, 2 => &$c] = $numbers;
echo print_r(new stdClass, true) . PHP_EOL;