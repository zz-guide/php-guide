<?php 
//1.preg_replace_callback — 执行一个正则表达式搜索并且使用一个回调进行替换
//preg_replace_callback — 执行一个正则表达式搜索并且使用一个回调进行替换
// 将文本中的年份增加一年.
$text = "April fools day is 04/01/2002\n";
$text.= "Last christmas was 12/24/2001\n";
// 回调函数
function next_year($matches)
{
  // 通常: $matches[0]是完成的匹配
  // $matches[1]是第一个捕获子组的匹配
  // 以此类推
  return $matches[1].($matches[2]+1);
}
echo preg_replace_callback(
            "|(\d{2}/\d{2}/)(\d{4})|",
            "next_year",
            $text);