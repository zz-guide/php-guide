<?php
/**
 * Created by PhpStorm.
 * User: xulei
 * Date: 2018/5/28
 * Time: 12:11
 */

define('EARTH_RADIUS', 6371);//地球半径，平均半径为6371km


/**
 * @param $lng
 * @param $lat
 * @param int $distance 单位是千米
 * @return array
 */
function returnSquarePoint($lng, $lat, $distance = 10){

    $dlng =  2 * asin(sin($distance / (2 * EARTH_RADIUS)) / cos(deg2rad($lat)));//求出的是角度

    $dlng = rad2deg($dlng);//角度转化为弧度


    $dlat = $distance/EARTH_RADIUS;
    $dlat = rad2deg($dlat);


    return array(
        'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
        'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
        'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
        'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
    );
}


//豪景大厦A座
$longitude = '116.328294';
$latitude = '39.981612';

//使用此函数计算得到结果后，带入sql查询。
$squares = returnSquarePoint($longitude, $latitude);

var_dump($squares);

$sql = <<<HEAD
SELECT `id`,`province`,`city`,`district`,`address`,`latitude`,`longitude` from `store` WHERE `latitude` <> 0 and `latitude`>{$squares['right-bottom']['lat']} 
AND `latitude`< {$squares['left-top']['lat']} AND `longitude` <> 0 AND `longitude` > {$squares['left-top']['lng']} AND
 `longitude` < {$squares['right-bottom']['lng']};
HEAD;

var_dump($sql);