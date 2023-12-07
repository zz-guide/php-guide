<?php 
//1.preg_filter — 执行一个正则表达式搜索和替换
//mixed preg_filter ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )
//preg_filter()等价于preg_replace()除了它仅仅返回(可能经过转化)与目标匹配的结果
$subject = array('1', 'a', '2', 'b', '3', 'A', 'B', '4'); 
$pattern = array('/\d/', '/[a-z]/', '/[1a]/'); 
$replace = array('A:$0', 'B:$0', 'C:$0'); 

echo "preg_filter returns\n";
print_r(preg_filter($pattern, $replace, $subject)); 

echo "preg_replace returns\n";
print_r(preg_replace($pattern, $replace, $subject)); 