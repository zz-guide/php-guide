<?php 
//1.preg_match函数的使用
//int preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] )
$subject = "abcdef";
$pattern = '/^def/';
//string substr ( string $string , int $start [, int $length ] )
/*
PREG_OFFSET_CAPTURE如果传递了这个标记，对于每一个出现的匹配返回时会附加字符串偏移量(相对于目标字符串的)。 注意：这会改变填充到matches参数的数组，使其每个元素成为一个由 第0个元素是匹配到的字符串，第1个元素是该匹配字符串 在目标字符串subject中的偏移量。 
 */
//返回值:preg_match()返回 pattern 的匹配次数。 它的值将是0次（不匹配）或1次，因为preg_match()在第一次匹配后 将会停止搜索。preg_match_all()不同于此，它会一直搜索subject直到到达结尾。 如果发生错误preg_match()返回 FALSE。
$result = preg_match($pattern, substr($subject,3), $matches, PREG_OFFSET_CAPTURE);
// Array
// (
//     [0] => Array
//         (
//             [0] => def
//             [1] => 0
//         )

// )
// preg_match($pattern, substr($subject,3), $matches);
//Array
// (
//     [0] => def
// )
echo $result;
echo "<pre>";
print_r($matches);

$subject = "abcdef";
$pattern = '/def/';
//offset
//通常，搜索从目标字符串的开始位置开始。可选参数 offset 用于 指定从目标字符串的某个未知开始搜索(单位是字节)。 
preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 2);
echo "<pre>";
print_r($matches);