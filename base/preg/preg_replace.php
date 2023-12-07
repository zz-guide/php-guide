<?php 
//1.preg_replace函数的使用,执行一个正则表达式的搜索和替换
//mixed preg_replace ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )
//limit
// 每个模式在每个subject上进行替换的最大次数。默认是 -1(无限)。 
// count
// 如果指定，将会被填充为完成的替换次数。
$string = 'April 15, 2003';
$pattern = '/(\w+) (\d+), (\d+)/i';
$replacement = '${1}1,$3';
echo preg_replace($pattern, $replacement, $string);
echo "<br>";
echo $string;

$string = 'The quick brown fox jumped over the lazy dog.';
$patterns = array();
$patterns[0] = '/quick/';
$patterns[1] = '/brown/';
$patterns[2] = '/fox/';
$replacements = array();
$replacements[2] = 'bear';
$replacements[1] = 'black';
$replacements[0] = 'slow';
echo preg_replace($patterns, $replacements, $string);

ksort($patterns);
ksort($replacements);
echo preg_replace($patterns, $replacements, $string);