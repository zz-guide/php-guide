<?php
/**
 * Created by PhpStorm.
 * User: xulei
 * Date: 2018/11/7
 * Time: 09:54
 */

class Distance
{
    const  DEF_PI = 3.14159265359; // PI
    const  DEF_2PI = 6.28318530712; // 2*PI
    const  DEF_PI180 = 0.01745329252; // PI/180.0
    const  DEF_R = 6370693.5; // radius of earth

    /**
     * 利用勾股定理计算，适用于两点距离很近的情况；有效与百度差距很小，50公里差2米
     */
    public static function getDistance($lon1, $lat1, $lon2, $lat2)
    {
        // 角度转换为弧度
        $ew1 = $lon1 * self::DEF_PI180;
        $ns1 = $lat1 * self::DEF_PI180;
        $ew2 = $lon2 * self::DEF_PI180;
        $ns2 = $lat2 * self::DEF_PI180;

        // 经度差
        $dew = $ew1 - $ew2;

        // 若跨东经和西经180 度，进行调整
        if ($dew > self::DEF_PI)
        $dew = self::DEF_2PI - $dew;
        else if ($dew < -self::DEF_PI)
        $dew = self::DEF_2PI + $dew;
        $dx = self::DEF_R * cos($ns1) * $dew;       // 东西方向长度(在纬度圈上的投影长度)
        $dy = self::DEF_R * ($ns1 - $ns2);          // 南北方向长度(在经度圈上的投影长度)

        // 勾股定理求斜边长
        $distance = sqrt($dx * $dx + $dy * $dy);
        return $distance;
    }

}