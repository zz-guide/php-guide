<?php 
//1.preg_match_all函数的使用,执行一个全局正则表达式匹配
//int preg_match_all ( string $pattern , string $subject [, array &$matches [, int $flags = PREG_PATTERN_ORDER [, int $offset = 0 ]]] )
//可以结合下面标记使用(注意不能同时使用PREG_PATTERN_ORDER和 PREG_SET_ORDER)： 
//PREG_PATTERN_ORDER
//结果排序为$matches[0]保存完整模式的所有匹配, $matches[1]保存第一个子组的所有匹配，以此类推。 
//PREG_SET_ORDER
//结果排序为$matches[0]包含第一次匹配得到的所有匹配(包含子组)， $matches[1]是包含第二次匹配到的所有匹配(包含子组)的数组，以此类推。 
// PREG_OFFSET_CAPTURE
// 如果这个标记被传递，每个发现的匹配返回时会增加它相对目标字符串的偏移量。 注意这会改变matches中的每一个匹配结果字符串元素，使其 成为一个第0个元素为匹配结果字符串，第1个元素为 匹配结果字符串在subject中的偏移量。
// offset
// 通常， 查找时从目标字符串的开始位置开始。可选参数offset用于 从目标字符串中指定位置开始搜索(单位是字节)。
//返回值:返回完整匹配次数（可能是0），或者如果发生错误返回FALSE
$result = preg_match_all("|<[^>]+>(.*)</[^>]+>|U",
    "<b>example: </b><div align=left>this is a test</div>",
    $out, PREG_PATTERN_ORDER);
echo $result;
echo "<pre>";
print_r($out);
echo $out[0][0] . ", " . $out[0][1] . "\n";
echo $out[1][0] . ", " . $out[1][1] . "\n";