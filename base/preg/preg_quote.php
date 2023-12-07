<?php 
//1.preg_quote — 转义正则表达式字符
//string preg_quote ( string $str [, string $delimiter = NULL ] )
//preg_quote()需要参数 str 并向其中 每个正则表达式语法中的字符前增加一个反斜线。 这通常用于你有一些运行时字符串 需要作为正则表达式进行匹配的时候。 

// 正则表达式特殊字符有： . \ + * ? [ ^ ] $ ( ) { } = ! < > | : - 


$keywords = '$40 for a g3/400';
$keywords = preg_quote($keywords, '/');
echo $keywords; // 返回 \$40 for a g3\/400


//在这个例子中，preg_quote($word) 用于保持星号原文涵义，使其不使用正则表达式中的特殊语义。

$textbody = "This book is *very* difficult to find.";
$word = "*very*";
$textbody = preg_replace ("/" . preg_quote($word) . "/",
                          "<i>" . $word . "</i>",
                          $textbody);