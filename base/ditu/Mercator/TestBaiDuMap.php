<?php
/**
 * Created by PhpStorm.
 * User: xulei
 * Date: 2018/9/14
 * Time: 12:23
 */

require_once './BaiDuCoordinateUtil.php';
require_once './BaiDuCoordinateUtil2.php';
require_once('../newmap/Distance.php');

ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set('date.timezone','Asia/Shanghai');

function getDistance($startLng, $startLat, $endLng, $endLat)
{
    if (!$startLng || !$startLat || !$endLng || !$endLat){
        return -1;
    }

    $startLatRad = deg2rad($startLat);
    $endLatRad = deg2rad($endLat);
    $a = $startLatRad - $endLatRad;
    $b = deg2rad($startLng) - deg2rad($endLng);
    $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($startLatRad) * cos($endLatRad) * pow(sin($b / 2), 2)));
    $s = $s * 6318137;
    $s = round($s * 10000) / 10000;

    return intval($s);
}

$longitude1 = '116.729554';
$latitude1 = '40.201299';

$longitude2 = '116.167269';
$latitude2 = '39.829948';



//方法一：框架自带
//$distance1 = getDistance($longitude1, $latitude1, $longitude2, $latitude2);
//var_dump('框架自带方法计算1，距离：' . $distance1 . '（米）');

//方法二：自研方法
//$distance2 = BaiDuMapService::getDistance($longitude1,$latitude1,$longitude2,$latitude2);
//var_dump('自研方法计算，距离：' . $distance2 . '（米）');

//方法三：网上的新方法
//$distance3 = BaiDuCoordinateUtil::getDistance($longitude1, $latitude1, $longitude2, $latitude2);
//var_dump('新方法计算2，距离：' . $distance3 . '（米）');

//计算周围的经纬度
//$around = BaiDuCoordinateUtil::getAround($longitude1, $latitude1, 200);
//var_dump('半径周围经纬度3，' , $around);

//$distance4 = BaiDuCoordinateUtil::getDistance($longitude1, $latitude1, $longitude2, $latitude2);
//var_dump('新方法计算4，距离：' . $distance4 . '（米）');

//五
//$distance4 = Distance::getDistance($longitude1, $latitude1, $longitude2, $latitude2);
//var_dump('新方法计算5，距离：' . $distance4 . '（米）');

$distance = BaiDuCoordinateUtil2::getDistance($longitude1, $latitude1, $longitude2, $latitude2);

var_dump($distance);