<?php 
//1.preg_split — 通过一个正则表达式分隔字符串
//array preg_split ( string $pattern , string $subject [, int $limit = -1 [, int $flags = 0 ]] )
//通过一个正则表达式分隔给定字符串. 
//使用逗号或空格(包含" ", \r, \t, \n, \f)分隔短语
/*
	flags
	flags 可以是任何下面标记的组合(以位或运算 | 组合)： 
	PREG_SPLIT_NO_EMPTY如果这个标记被设置， preg_split() 将进返回分隔后的非空部分。 PREG_SPLIT_DELIM_CAPTURE如果这个标记设置了，用于分隔的模式中的括号表达式将被捕获并返回。 PREG_SPLIT_OFFSET_CAPTURE
	如果这个标记被设置, 对于每一个出现的匹配返回时将会附加字符串偏移量. 注意：这将会改变返回数组中的每一个元素, 使其每个元素成为一个由第0个元素为分隔后的子串，第1个元素为该子串在subject中的偏移量组成的数组。
	 
	 limit
	如果指定，将限制分隔得到的子串最多只有limit个，返回的最后一个 子串将包含所有剩余部分。limit值为-1， 0或null时都代表"不限制"， 作为php的标准，你可以使用null跳过对flags的设置。

 */


$keywords = preg_split("/[\s,]+/", "hypertext language, programming");
print_r($keywords);

$str = 'string';
$chars = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
print_r($chars);


$str = 'hypertext language programming';
$chars = preg_split('/ /', $str, -1, PREG_SPLIT_OFFSET_CAPTURE);
print_r($chars);