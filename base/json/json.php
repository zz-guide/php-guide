<?php
/**
 *
 * @author:  leixu
 * @version: 1.0.0
 * @change:
 *    1. 2022/7/21 leixu: 创建；
 */

$num = "9000000000000000000000000000000000000000000000";
$data = $num * 1000;
print_r($data);die;// 科学计数法 9.0E+48%
$str = '[{"id":"93854","distance":1.0e 49}]';
$res = json_decode($str, true);
$ret = json_last_error();
var_dump($res);
var_dump($ret);
die;

// 数字太大会转化成科学计数法，并且没办法json_decode