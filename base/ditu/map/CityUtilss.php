<?php
/**
 * Created by PhpStorm.
 * User: xulei
 * Date: 2018/11/1
 * Time: 19:22
 */
require_once('./City.php');

class CityUtilss
{
    protected $cityList = [
        '北京市', '天津市', '上海市', '重庆市'
    ];

    public function _readBaiDuMapJson()
    {
        $json_string = file_get_contents('./2018baidumap.json');
        return json_decode($json_string, true);
    }

    //市-》省
    public function cityMap()
    {
        $baiduData = $this->_readBaiDuMapJson();
        $provinceColumn = array_column($baiduData, 'province');
        $cityColumn = array_column($baiduData, 'city');
        $final = array_combine($cityColumn, $provinceColumn);

        $str = "";
        foreach ($final as $key => $item) {
            if ($key == $item && !in_array($item, $this->cityList)) {
                continue;
            }

            $lastKey = mb_substr($key, -1, 1, 'UTF-8');
            if ($lastKey == '市') {
                $key = mb_substr($key, 0, -1, 'UTF-8');
            }

            $lastItem = mb_substr($item, -1, 1, 'UTF-8');
            if ($lastItem == '省') {
                $item = mb_substr($item, 0, -1, 'UTF-8');
            } else if ($lastItem == '市') {
                $item = mb_substr($item, 0, -1, 'UTF-8');
            }

            $str .= "\"" . $key . '" => ["' . $item . '"],' . "\n\t\t";
        }

        file_put_contents('./cityMap.txt', $str);
    }

    //市=》区县
    public function cityCounties()
    {
        $baiDuData = $this->_readBaiDuMapJson();
        $cityColumn = array_unique(array_column($baiDuData, 'city'));
        $final = [];

        foreach ($cityColumn as $city) {
            if (strpos('省', $city) !== FALSE) {
                continue;
            }

            $final[$city] = [];
            foreach ($baiDuData as $item) {
                if ($item['city'] == $city) {
                    array_push($final[$city], $item['district']);
//                    if ($item['district'] != $city) {
//
//                    }
                }
            }
        }

        unset($item);
        $str = "";
        foreach ($final as $key => $item) {
            if ($item == []) {
                continue;
            }

            $lastKey = mb_substr($key, -1, 1, 'UTF-8');
            if ($lastKey == '市') {
                $key = mb_substr($key, 0, -1, 'UTF-8');
            }

            $tmp = "\"" . join("\",\"", $item) . "\"";
            $str .= "\"" . $key . '" => [' . $tmp . '],' . "\n\t\t";
        }

        file_put_contents('./cityCounties.txt', $str);

    }

    /**
     * 获取首字母
     * @param  string $str 汉字字符串
     * @return string 首字母
     */
    public function getInitials($str)
    {
        $s0 = mb_substr($str,0,3); //获取名字的姓
        $s = iconv('UTF-8','gb2312', $s0); //将UTF-8转换成GB2312编码
        if (ord($s0)>128) { //汉字开头，汉字没有以U、V开头的
            $asc=ord($s{0})*256+ord($s{1})-65536;
            if($asc>=-20319 and $asc<=-20284)return "A";
            if($asc>=-20283 and $asc<=-19776)return "B";
            if($asc>=-19775 and $asc<=-19219)return "C";
            if($asc>=-19218 and $asc<=-18711)return "D";
            if($asc>=-18710 and $asc<=-18527)return "E";
            if($asc>=-18526 and $asc<=-18240)return "F";
            if($asc>=-18239 and $asc<=-17760)return "G";
            if($asc>=-17759 and $asc<=-17248)return "H";
            if($asc>=-17247 and $asc<=-17418)return "I";
            if($asc>=-17417 and $asc<=-16475)return "J";
            if($asc>=-16474 and $asc<=-16213)return "K";
            if($asc>=-16212 and $asc<=-15641)return "L";
            if($asc>=-15640 and $asc<=-15166)return "M";
            if($asc>=-15165 and $asc<=-14923)return "N";
            if($asc>=-14922 and $asc<=-14915)return "O";
            if($asc>=-14914 and $asc<=-14631)return "P";
            if($asc>=-14630 and $asc<=-14150)return "Q";
            if($asc>=-14149 and $asc<=-14091)return "R";
            if($asc>=-14090 and $asc<=-13319)return "S";
            if($asc>=-13318 and $asc<=-12839)return "T";
            if($asc>=-12838 and $asc<=-12557)return "W";
            if($asc>=-12556 and $asc<=-11848)return "X";
            if($asc>=-11847 and $asc<=-11056)return "Y";
            if($asc>=-11055 and $asc<=-10247)return "Z";
        }else if(ord($s)>=48 and ord($s)<=57){ //数字开头
            switch(iconv_substr($s,0,1,'utf-8')){
                case 1:return "Y";
                case 2:return "E";
                case 3:return "S";
                case 4:return "S";
                case 5:return "W";
                case 6:return "L";
                case 7:return "Q";
                case 8:return "B";
                case 9:return "J";
                case 0:return "L";
            }
        }else if(ord($s)>=65 and ord($s)<=90){ //大写英文开头
            return substr($s,0,1);
        }else if(ord($s)>=97 and ord($s)<=122){ //小写英文开头
            return strtoupper(substr($s,0,1));
        }

        var_dump($str);die;
        //中英混合的词语，不适合上面的各种情况，因此直接提取首个字符即可
        return iconv_substr($s0,0,1,'utf-8');

    }

    public function groupByInitials($data)
    {
        $final = array_map(function ($item) {
            return array_merge($item, [
                'province_s' => $this->getInitials($item['province']),
                //'city_s' => $this->getInitials($item['city']),
                //'district_s' => $this->getInitials($item['district']),
            ]);
        }, $data);

        file_put_contents('baiduzimupaixu.json', json_encode($final,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }

    public function sortBaiDu()
    {
        $baiduData = $this->_readBaiDuMapJson();
        $this->groupByInitials($baiduData);
    }

    public function transformCityCode()
    {
        $baiDuData = $this->_readBaiDuMapJson();
        $cityColumn = array_unique(array_column($baiDuData, 'city'));
        $myCityColumn = City::getCityCode();

        foreach ($cityColumn as $key => &$item) {

            $lastItem = mb_substr($item, -1, 1, 'UTF-8');
            if ($lastItem == '省') {
                $item = mb_substr($item, 0, -1, 'UTF-8');
            } else if ($lastItem == '市') {
                $item = mb_substr($item, 0, -1, 'UTF-8');
            }

            //$str .= "\"" . $key . '" => ["' . $item . '"],' . "\n\t\t";
        }

        unset($item);
        unset($key);
        foreach ($cityColumn as $key => &$item) {
            if (in_array($item, $myCityColumn)) {
                unset($cityColumn[$key]);
            }
        }

        var_dump($cityColumn);die;
    }

}

$task = new CityUtil();
$task->cityCounties();