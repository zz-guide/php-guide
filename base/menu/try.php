<?php
/**
 *
 * @author:  leixu
 * @version: 1.5.0
 * @change:
 *    1. 2019/12/26 leixu: 创建；
 */
ini_set("display_errors", "On");
error_reporting(E_ALL);
class PPP {
    public function pp()
    {
        try {
            $c = new Children();
            return 'hah';
        } catch (Exception $e) {

        }

        return "111";
    }
}

class Children {
    /**
     * Children constructor.
     * @throws Exception
     */
    public function __construct()
    {
       // throw new \Exception("dasdasdasd");
    }
}

$p = new PPP();
var_dump($p->pp());
