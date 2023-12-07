<?php

// php -S localhost:9990 -t .

$callback = $_GET['callback'];
$value = ["name" => "许磊", "id" => 123];
$data = json_encode($value);
// 加了sleep之后可能存在卡顿的问题
sleep(3);
echo $callback.'('.$data.')';