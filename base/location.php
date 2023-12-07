<?php

ob_end_flush();
$u = urlencode("http://www.baidu.com?a=1");
$url = "/test.php?r={$u}";
//header("HTTP/1.1 301 Moved Permanently");
header("Location:$url");
ob_start();