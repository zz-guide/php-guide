<?php
/**
 * 高德地图工具
 * @author:  leixu
 * @version: 1.5.0
 * @change:
 *    1. 2018/12/27 leixu: 创建；
 */
require_once './LatLng.php';

class AMapUtil
{
    const DISTANCE_PARAM_1 = 0.01745329251994329;
    const DISTANCE_PARAM_2 = 1.27420015798544E7;

    /**
     * 计算高德地图两点之间较短直线距离
     * @param LatLng $startLL
     * @param LatLng $endLL
     * @return float
     */
    public static function calculateLineDistance(LatLng $startLL, LatLng $endLL)
    {
        if (!$startLL || !$endLL) {
            return 0.0;
        }

        $stLongitude = $startLL->longitude;
        $stLatitude = $startLL->latitude;
        $endLongitude = $endLL->longitude;
        $endLatitude = $endLL->latitude;

        $stLongitude *= self::DISTANCE_PARAM_1;
        $stLatitude *= self::DISTANCE_PARAM_1;
        $endLongitude *= self::DISTANCE_PARAM_1;
        $endLatitude *= self::DISTANCE_PARAM_1;

        $stLongitudeSin = sin($stLongitude);
        $stLatitudeSin = sin($stLatitude);

        $stLongitudeCos = cos($stLongitude);
        $stLatitudeCos = cos($stLatitude);

        $endLongitudeSin = sin($endLongitude);
        $endLatitudeSin = sin($endLatitude);

        $endLongitudeCos = cos($endLongitude);
        $endLatitudeCos = cos($endLatitude);

        $st[0] = $stLatitudeCos * $stLongitudeCos;
        $st[1] = $stLatitudeCos * $stLongitudeSin;
        $st[2] = $stLatitudeSin;

        $end[0] = $endLatitudeCos * $endLongitudeCos;
        $end[1] = $endLatitudeCos * $endLongitudeSin;
        $end[2] = $endLatitudeSin;

        $result = sqrt(($st[0] - $end[0]) * ($st[0] - $end[0]) + ($st[1] - $end[1]) * ($st[1] - $end[1]) + ($st[2] - $end[2]) * ($st[2] - $end[2]));
        return (float)(asin($result / 2.0) * self::DISTANCE_PARAM_2);
    }
}