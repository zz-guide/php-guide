<?php

ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set('date.timezone','Asia/Shanghai');
ini_set('memory_limit', '-1');

require_once('./City.php');
/**
 * Created by PhpStorm.
 * User: xulei
 * Date: 2018/11/1
 * Time: 21:09
 */



$cityBk = City::provinceCityDistrictsTree();
$data = [
    'errcode' => 200,
    'errmsg' => '请求成功',
    'data' => $cityBk
];

$data = json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
file_put_contents('./my-province-city-district.json', $data);
//var_dump($cityBk);