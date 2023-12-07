<?php
/**
 * 高德地图经纬度实例类
 * @author:  leixu
 * @version: 1.5.0
 * @change:
 *    1. 2019/7/5 leixu: 创建；
 */

class LatLng
{
    public $longitude;
    public $latitude;

    public function __construct($longitude, $latitude)
    {
        if (-180.0 <= $longitude && $longitude < 180.0) {
            $this->longitude = $longitude;
        } else {
            $this->longitude = (($longitude - 180.0) % 360.0 + 360.0) % 360.0 - 180.0;
        }

        $this->latitude = max([-90.0, min([90.0, $latitude])]);
    }
}