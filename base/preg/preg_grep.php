<?php 
//1.preg_grep — 返回匹配模式的数组条目
//array preg_grep ( string $pattern , array $input [, int $flags = 0 ] )
//返回给定数组input中与模式pattern匹配的元素组成的数组. 
// 返回所有包含浮点数的元素
$array = array('name'=>'xulei',6);
$fl_array = preg_grep("/^(\d+)?\.\d+$/", $array);
echo "<pre>";
print_r($fl_array);
preg_match('/(?:\D+|<\d+>)*[!?]/', 'foobar foobar foobar');
/*
preg_last_error — 返回最后一个PCRE正则执行产生的错误代码
返回下面常量中的一个(查看它们自身的解释): 
•PREG_NO_ERROR
•PREG_INTERNAL_ERROR
•PREG_BACKTRACK_LIMIT_ERROR （参见 pcre.backtrack_limit）
•PREG_RECURSION_LIMIT_ERROR （参见 pcre.recursion_limit）
•PREG_BAD_UTF8_ERROR
•PREG_BAD_UTF8_OFFSET_ERROR （自 PHP 5.3.0 起）


 */
if (preg_last_error() == PREG_BACKTRACK_LIMIT_ERROR) {
    print 'Backtrack limit was exhausted!';
}