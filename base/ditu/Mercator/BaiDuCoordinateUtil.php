<?php

/**
 * 百度经纬度距离计算（精确）
 * Class BaiDuMap
 */
class BaiDuCoordinateUtil
{
    const PI = 3.141592653589793;             //PI的近似值，取java中定义好的
    const EARTH_RADIUS = 6370996.81;           //地球半径，单位米
    const DEF_PI180 = 0.017453292519943295;   //PI/180.0

    /**
     * 经纬度转墨卡托
     * @param $longitude
     * @param $latitude
     * @return array
     */
    public static function llToMercator($longitude, $latitude) {
        $mlo = ($longitude * 20037508.342789 / 180);
        $mla = (log(tan((90 + $latitude) * self::PI / 360)) / (self::PI / 180));
        $mla = ($mla * 20037508.342789 / 180);
        return [$mlo, $mla];
    }

    /**
     * 墨卡托转经纬度
     * @param $longitude
     * @param $latitude
     * @return array
     */
    public static function mercatorToLL($longitude, $latitude) {
         $mlo = ($longitude / 20037508.342789 * 180);
         $mla = ($latitude() / 20037508.342789 * 180);
         $mla = (180 / self::PI * (2 * atan(exp($mla * self::PI / 180)) - self::PI / 2));
         return [$mlo, $mla];
    }

    public static function OD($a, $b, $c) {
        while ($a > $c) $a -= $c - $b;
        while ($a < $b) $a += $c - $b;
        return $a;
    }

    public static function SD($a, $b, $c) {
        $b != null && ($a = max($a, $b));
        $c != null && ($a = min($a, $c));
        return $a;
    }

    /**
     * 计算两个经纬度之间的距离（只适用于与bd09ll坐标）
     * @param $startLongitude
     * @param $startLatitude
     * @param $endLongitude
     * @param $endLatitude
     * @return float|int
     */
    public static function getDistance($startLongitude, $startLatitude, $endLongitude, $endLatitude) {
        $a = self::PI * self::OD($startLatitude, -180, 180) / 180;
        $b = self::PI * self::OD($endLatitude, -180, 180) / 180;
        $c = self::PI * self::SD($startLongitude, -74, 74) / 180;
        $d = self::PI * self::SD($endLongitude, -74, 74) / 180;

        $result = self::EARTH_RADIUS * acos(sin($c) * sin($d) + cos($c) * cos($d) * cos($b-$a));
        return number_format($result, 2, '.', '');
    }

    public static function getAround($longitude, $latitude, $radius)
    {
        //角度转换为弧度
        $ns = $latitude * self::DEF_PI180;
        $sinNs = sin($ns);
        $cosNs = cos($ns);
        $cosTmp = cos($radius / self::EARTH_RADIUS);

        //经度的差值
        $lonDif = acos(($cosTmp - $sinNs * $sinNs) / ($cosNs * $cosNs)) / self::DEF_PI180;

        $m = 0 - 2 * $cosTmp * $sinNs;
        $n = $cosTmp * $cosTmp - $cosNs * $cosNs;
        $o1 = (0 - $m - sqrt($m * $m - 4 * ($n))) / 2;
        $o2 = (0 - $m + sqrt($m * $m - 4 * ($n))) / 2;

        //纬度
        $lat1 = 180 / self::PI * asin($o1);//小
        $lat2 = 180 / self::PI * asin($o2);//大

        //顺序一定不能乱
        return [
            'left-top'      => ['lng' => $longitude - $lonDif, 'lat' => $lat2],
            'right-top'     => ['lng' => $longitude + $lonDif, 'lat' => $lat2],
            'left-bottom'   => ['lng' => $longitude - $lonDif, 'lat' => $lat1],
            'right-bottom'  => ['lng' => $longitude + $lonDif, 'lat' => $lat1],
        ];
    }
}