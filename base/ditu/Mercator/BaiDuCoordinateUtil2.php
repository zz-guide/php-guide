<?php

/**
 * 百度经纬度距离计算
 * Class BaiDuMap
 */
class BaiDuCoordinateUtil2
{
    const PI = 3.141592653589793;              //PI的近似值，取java中定义好的
    const EARTH_RADIUS = 6370693.5;            //地球半径，单位米
    const DEF_PI180 = 0.017453292519943295;    //PI/180.0
    const DEF_2PI = 6.28318530712;             // 2*PI

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
     * 根据标点的经纬度坐标计算距离
     *
     * @param float $startLng 起点的经度
     * @param float $startLat 起点的纬度
     * @param float $endLng 终点的经度
     * @param float $endLat 终点的纬度
     * @return integer
     */
    public static function getDistance($startLng, $startLat, $endLng, $endLat)
    {
        if (!$startLng || !$startLat || !$endLng || !$endLat){
            return -1;
        }

        // 角度转换为弧度
        $ew1 = $startLng * self::DEF_PI180;
        $ns1 = $startLat * self::DEF_PI180;
        $ew2 = $endLng * self::DEF_PI180;
        $ns2 = $endLat * self::DEF_PI180;

        // 经度差
        $dew = $ew1 - $ew2;

        // 若跨东经和西经180 度，进行调整
        if ($dew > self::PI)
            $dew = self::DEF_2PI - $dew;
        else if ($dew < -self::EARTH_RADIUS)
            $dew = self::DEF_2PI + $dew;
        $dx = self::EARTH_RADIUS * cos($ns1) * $dew;       // 东西方向长度(在纬度圈上的投影长度)
        $dy = self::EARTH_RADIUS * ($ns1 - $ns2);          // 南北方向长度(在经度圈上的投影长度)

        // 勾股定理求斜边长
        $distance = sqrt($dx * $dx + $dy * $dy);
        return $distance;
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