<?php
/**
 *
 * @author:  leixu
 * @version: 1.5.0
 * @change:
 *    1. 2019/12/26 leixu: 创建；
 */


class FFF
{
    /**
     * 暴力求解
     * @param $n
     * @return int
     */
    public static function f1($n)
    {
        if ($n < 1) {
            return 0;
        }

        if ($n == 1 || $n == 2) {
            return 1;
        }

        return self::f1($n - 1) + self::f1($n - 2);
    }

    /**
     * 尾递归
     * @param $n
     * @return int
     */
    public static function f2($n)
    {
        if ($n < 1) {
            return 0;
        }

        if ($n == 1 || $n == 2) {
            return 1;
        }

        $pre = 1;//第一个
        $res = 1;//第二个

        for ($i = 3; $i <= $n; $i++) {
            $temp = $res;
            $res += $pre;
            $pre = $temp;
        }

        return $res;
    }

    /**
     * 动态规划
     * @param $n
     * @return int
     */
    public static function f3($n)
    {
        if ($n < 1) {
            return 0;
        }

        if ($n == 1 || $n == 2) {
            return 1;
        }

        $pre = 0;
        $next = 1;
        while($n-- > 0) {
            $next = $pre + $next;
            $pre = $next - $pre;
        }

        return $pre;
    }
}


$result = FFF::f3(4);
$result = FFF::f1(4);
var_dump($result);



