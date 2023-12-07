<?php
ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set('date.timezone','Asia/Shanghai');
set_time_limit(5);
echo "<pre>";

//过滤硬件设备的控制字符
//$str = "                            zqq                        ";
//$a = preg_replace('/[\x00-\x1f]|\x7f/i', '', $str);
//$a = str_replace(' ', '', $str);
//print_r($a);
//print_r(1);

//$a = ['2019-01-01','2019-02-02', '2020-01-01'];
//var_dump(max($a));


//var_dump(date('n', strtotime('2019-01-07')));
//var_dump(date('w', strtotime('2019-09-29')));


//var_dump(array_rand([1,2], 0));//会报错


//$title = 'Find# #And# #Keep# #Your# #Friendship';
//$title = preg_replace('/#/', "", $title);

//var_dump($title);

//$value = '许磊';
//$str = mb_convert_encoding($value, "UTF-8", "GBK");
//var_dump($str);

//$value = '杨女士';
//$a = iconv("utf-8", "gbk", $value);
//var_dump($a);

//$a = [[1,2], [3,4]];
//var_dump(...$a);

//$a = ['-1' => 2, 0 => 2];
//var_dump($a);

//$e = null;
//$a = '';
//$b = '0000-00-00 00:00:00';
//$c = '2020-01-15 12:12:12';
//$d = '2020-01-16 12:12:12';
//
//var_dump(max($a, $b, $c, $d, $e));

//$a = ['aaa' => '222'];
//$b = [['sss'=> 'xxxx']];
//var_dump($a);
//var_dump($b);

/*$field = [
    'wrt_duration',
    'who_duration',
    'whm_duration',
    'whd_duration',
    'whs_duration',
    'wr_duration',
    'wp_duration',
    'wt_duration',
    'lsh_duration',
    'ssh_duration',
    'sr_duration',
    'a_duration',
    'lsrt_duration',
    'ssrt_duration',
    'grt_duration',
    'gr_duration',
    'gh_duration',
    'gp_duration'
];

$studentField = [
    'id',
    'name',
    'sn',
    'wordset_expire_at',
    'review_type',
    'type',
    'spell_mode',
    'review_spell_mode',
    'pad_mode',
    'store_id',
    'class_id',
    'teacher_user_id',
    'is_finish',
    'is_attention',
    'is_train'
];*/

//$str = "SUM(A.`" . implode("`+A.`", $field) . "`) AS `total_duration`";
//$str = "A.`" . implode("`,A.`", $studentField) . "`";
//var_dump($str);


//$start = 0;
//$count = 20;
//
//$date = new DateTime();
//$dates = [$date->modify("-{$start} day")->format('Y-m-d')];
//
//var_dump($dates);die;
//for($i = 1; $i < $count - $start; $i++) {
//    $dates[] = $date->modify('-1 day')->format('Y-m-d');
//}
//
//var_dump($dates);

//$a['1'] = ['unit_no1' => 'ssss'];
//$a['1']['course_name'] = 'ssssss';
//var_dump($a);

//$studentData = [1,1,1,1,];
////全部未开始叫未开始，全部已学完叫已学完，其余都算作学习中
//$unique = array_unique($studentData);
//
//if ($unique == [0]) {
//    $data['study_status'] = 0;
//} else if ($unique == [2]) {
//    $data['study_status'] = 2;
//} else {
//    $data['study_status'] = 1;
//}
//
//var_dump($data);

/*$a = [
    '2' => 'A',
//    1 => 'B',
    'C',
    6 => 'D',
    'N'
];*/


//$str = "%E4%B8%AD%E5%9B%BD%E5%8C%97%E4%BA%AC%E5%B8%82%E6%98%8C%E5%B9%B3%E5%8C%BA%E9%9C%8D%E8%90%A5%E8%A1%97%E9%81%93%E5%9B%9E%E5%8D%97%E5%8C%97%E8%B7%AF";
//$a = urldecode($str);
//var_dump($a);

//'小学考纲词库       ',
//'小学高分培优词库     ',
//'小升初必背句型(新版)  ',
//'小升初英语核心语法    ',
//'小升初核心语法(一)   ',
//'小升初核心语法(二)   ',
//'小升初核心语法(三)   ',
//'小升初核心语法(四)   ',
//'高考考纲词库(完全版)  ',
//'高考考纲阶段一(基础词) ',
//'高考考纲阶段二(进阶词) ',
//'高考高分培优词库     ',
//'初升高衔接词库      ',
//'高中艺考词库       ',
//'高考精编高频词汇     ',
//'四级核心词库       ',
//'高考升四级词库      ',
//'六级核心词库       ',
//'四级升六级词库      ',
//'托福核心词        ',
//'雅思核心词        ',
//'中考考纲词库(完全版)  ',
//'中考必背句型       ',
//'中考考纲阶段一(基础词) ',
//'中考考纲阶段二(进阶词) ',
//'中考高分培优词库     ',
//'小升初衔接词库      ',
//'中考核心语法       ',
//'中考核心语法       ',
//'中考核心语法(一)    ',
//'中考核心语法(二)    ',
//'中考核心语法(三)    ',
//'中考核心语法(四)    ',
//'26个英文字母      ',
//'自然拼读课程(需复习版) ',
//'自然拼读课程(无复习版) ',
//'自然拼读课程(一)    ',
//'自然拼读课程(二)    ',
//'自然拼读课程(三)    ',
//'自然拼读课程(四)    ',
//'四级培训词库       ',
//'六级培训词库       ',
//'专八培训词库       ',
//'小学语法体验       ',
//'初中语法体验       ',
//'高中语法体验       ',
//'四级核心词库       ',
//'高考升四级词库      ',
//'六级核心词库       ',
//'四级升六级词库      ',
//'托福核心词        ',
//'雅思核心词        ',
//'剑桥KET考纲词库    ',
//'剑桥PET考纲词库    ',
//'剑桥少儿英语一级     ',
//'剑桥少儿英语二级     ',
//'剑桥少儿英语三级     ',
//'新概念英语1       ',
//'新概念英语2       ',
//'新概念英语3       ',
//'新概念英语4       ',
//'新概念英语青少版0A   ',
//'新概念英语青少版0B   ',
//'新概念英语青少版1A   ',
//'新概念英语青少版1B   ',
//'新概念英语青少版2A   ',
//'新概念英语青少版2B   ',
//'新概念英语青少版3A   ',
//'新概念英语青少版3B   ',
//'新概念英语青少版4A   ',
//'同步课本         '

//$content = str_replace("</div>", "<br></div>",$content);
//$content = str_replace("<br>", "\n",$content);
//$content = str_replace("<br/>", "\n",$content);
//// 防止html剔除后，两个单词连到一起
//$content = str_replace("</", " </",$content);
//$content = str_replace("&nbsp;", " ",$content);
//$content = trim(strip_tags($content));
//$content = str_replace("&#039;", "'", $content);
//
//print_r($content);

/*class AAA
{
    public static function ss()
    {
        return [
            '1' => 'asdasd',
            '5' => 'xxx'
        ];
    }
}


foreach (AAA::ss() as $a => $key) {
    var_dump($a, $key);
}*/

//$a = [1,2];
//$b = [3,4];
//var_dump(implode(',', [$a, $b]));

//echo str_replace("images/","","images/asdasdasdasd");

//var_dump(date('Y-m-d H:i:s', strtotime("+3 month")));
//$agentIds = [116,117,119,120,123,127,139,140,141,144,148,149,150,151,153,156,157,164,165,166,172,175,178,179,181,182,188,196,197,199,200,203,222,224,225,227,229,230,231,233,234,238,244,246,247,265];
//$len = count($agentIds);
//foreach ($agentIds as $key => $agentId) {
//    $index = $key + 1;
//    $progress = floor($index/$len * 100);
//    echo "当前正在执行{$agentId}->86,进度{$progress}%\n";
//    sleep(2);
//}

//$a = ['哈哈', '22'];

//unset($a[0]);
//var_dump($a);

//var_dump(md5(123));die;
//签名 md5(strtolower(sha1(strtolower("{$t_id}-{$slu_id}-Share-{$time}-{$type}")-{$sn})))
//$str = '';
//$str = md5(strtolower(sha1(strtolower("123-456"))));
//var_dump($str);

//$str = "md-zl/69/94f50888e3adfdcd5da5a95e150c40e3,md-zl/69/731827405d2755cb67d9b265af31b3cc,
//md-zl/254/36642c5a9a928bd9742e2c54c9a6de87,md-zl/223/cc434f79954fa6a355bb28ce4de978b6,
//md-zl/243/d3923a03058869a18bb7d6da325525ae,md-zl/243/b5c803c481709830e5842622d55225d2,
//md-zl/243/91da1bbf77ed3ff87bccfbdb26de1b13,md-zl/243/7c8ace225174b3f11521008a8ed76c71,
//md-zl/243/14fe7305acf671b16f75f44cbfb71aa9,md-zl/243/467401a52b99430a106c6a5a97abbe87,
//md-zl/243/f9096e49a55340d2f1581ede69cfff36,md-zl/243/70345e178ac7f82d273ae949749803d7,
//md-zl/223/c100ba2db107099b4d0baa778b4bf6fe,md-zl/252/cf98aeb2cfe04b47b85155403d238e4c,
//md-zl/225/7649c603ff3b4dad533958931d2b2e4f,md-zl/225/76cb3573fd6a45874985ac1105987063,
//md-zl/225/4dd249d85dcc56f5eb429981cb4795cf,md-zl/225/d9546cfa1ba238cad1209f6c4f961789,
//md-zl/225/a933c97229ce24ab4b7fa3ce6e3877b6,md-zl/225/6adb74e000842af0597869d7ff22cc29,
//md-zl/225/c21d79359cae208def174e0bbf1f90e8,md-zl/225/e8e75a50278676c315e7cc328c640d22,
//md-zl/225/c47433e54f0d96d999c9d1a8e1504853,md-zl/246/7417e25c4e94a937228bd98375d";

//$arr = explode(',', $str);

//$a = [5];
//var_dump(min($a), max($a));

//function isContinue(array $number)
//{
//    $min = null;
//    $max = null;
//    if (!$number) {
//        return [false, $min, $max];
//    }
//
//    $number = array_unique($number);
//    sort($number, SORT_ASC);
//    $min = min($number);
//    $max = max($number);
//
//    if (($max - $min) > (count($number) - 1)) {
//        return [false, $min, $max];
//    }
//
//    return [true, $min, $max];
//}

//$number = [0,0,1,2];
//list($result, $minUnitNo, $maxUnitNo) = isContinue($number);
//var_dump($result, $minUnitNo, $maxUnitNo);
//var_dump(date('Y-m-d 00:00:00'));
//$startAt = '2019-12-25';
//var_dump(date('Y-m-d', strtotime("{$startAt} +6 month")));


//$a = '0000-00-00';
//var_dump($a < '2020-05-18');

//$a = array_filter(['', '']);
//var_dump($a);

//$a = -0;
//var_dump(intval($a));

//$a = '@@0';
//var_dump(trim($a, '@@'));

//$b = [1,2,3];//原来的
//$a = [];//新的

//$noChangeStoreIds = array_intersect($a, $b);
//$clearStoreIds = array_diff($b, $noChangeStoreIds);
//$addStoreIds = array_diff($a, $noChangeStoreIds);
//var_dump($noChangeStoreIds);
//var_dump($clearStoreIds);
//var_dump($addStoreIds);

//$str = '2020-06-05';
//$date = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($str)));
//var_dump($date);

//$a = [1,2];
//$b = ['2','1'];
//var_dump(array_diff($a, $b));
//$a = 1;
//$b = function () {
//    return 2;
//};
//
//var_dump($a && $b());

//var_dump(date_format('2020-02-02 22:22:22', 'Y-m-d H:i'));

//$yesterday = date("Y-m-d", strtotime("-1 day"));
//$month = 6;
//$result = date('Y-m-d', strtotime("$yesterday - {$month} month"));
//var_dump($result);

/*$str = '{
$str1 = '[{"e":"grandpa","c":"(口语)祖父","t":"2","a":"1"},{"e":"mother","c":"母亲;妈妈","t":"2","a":"1"}]';

$str = json_decode($str, true);
$str1 = json_decode($str1, true);
$newContent = [];
foreach ($str1 as $key => $c) {
    if (isset($c['e'])) {
        $newContent = $str1;
        break;
    } else {
        $newContent = array_merge($newContent, $c);
    }
}

print_r($newContent);*/


//$result = [
//    'left-top'      => ['lng' => 123123.2222, 'lat'=>1213123.22],
//    'right-top'     => ['lng' => 123123.2221],
//    'left-bottom'   => ['lng' => 123123.2223],
//    'right-bottom'  => ['lng' => 123123.2224],
//];
//
//$key = array_rand($result, 1);
//
//var_dump($key);


//echo count(array_values(array_filter(array_unique(explode(',', $str1)))));

//$a = false || (false && true);

//var_dump($a);
//$deviceIds = [
//    "00000000-6a2b-5292-ffff-ffff86e5a7c9",
//    "00000000-6a2b-5292-ffff-ffffcdef0822",
//    "00000000-6a2b-5292-ffff-ffffe7ed53f5",
//    "00000000-6650-ef10-0000-00000aff8ff5",
//    "00000000-6a2b-5292-0000-00003b80b7a2",
//    "00000000-6650-ef10-ffff-ffff89673871",
//    "00000000-6a2b-5292-0000-0000146022ac",
//    "00000000-6a2b-5292-ffff-ffffe638814b",
//    "00000000-6650-ef10-0000-00000c8a9e06",
//    "00000000-6650-ef10-ffff-ffff9aab04c4",
//    "00000000-6a2b-5292-ffff-ffff9688521f",
//    "00000000-6a2b-5292-ffff-ffffe74443c9",
//    "00000000-6650-ef10-ffff-ffff89673dcf",
//    "00000000-6a2b-5292-ffff-ffffe7ed5da5",
//    "00000000-6a2b-5292-ffff-ffffed1e5850",
//    "00000000-6a2b-5292-0000-0000155dc7a6",
//    "00000000-6650-ef10-ffff-ffff89673788",
//    "00000000-6a2b-5292-ffff-ffffeaf710ed",
//    "00000000-6a2b-5292-0000-000012e3a2d2",
//    "00000000-6a2b-5292-ffff-ffffec3ce498",
//    "00000000-6a2b-5292-ffff-ffffe9eb571f",
//    "00000000-6a2b-5292-ffff-ffffb2d98966",
//    "00000000-6650-ef10-0000-0000139bd376",
//    "00000000-6a2b-5292-0000-0000155dc7a3",
//    "00000000-6a2b-5292-0000-000072b22d09",
//    "00000000-6650-ef10-ffff-ffff86ed1685",
//    "00000000-6a2b-5292-ffff-ffffe8edae6c",
//    "00000000-6a2b-5292-ffff-fffff695b7cc",
//    "00000000-6a2b-5292-0000-000039069595",
//    "00000000-6650-ef10-ffff-ffff86ed16a3",
//    "00000000-6650-ef10-0000-00000aff8feb",
//];
//
//$deviceIds1 = [
//    "00000000-6a2b-5292-ffff-ffff86e5a7c9",
//    "00000000-6a2b-5292-ffff-ffffcdef0822",
//    "00000000-6a2b-5292-ffff-ffffe7ed53f5",
//    "00000000-6650-ef10-0000-00000aff8ff5",
//    "00000000-6a2b-5292-0000-00003b80b7a2",
//    "00000000-6650-ef10-ffff-ffff89673871",
//    "00000000-6a2b-5292-0000-0000146022ac",
//    "00000000-6a2b-5292-ffff-ffffe638814b",
//    "00000000-6650-ef10-0000-00000c8a9e06",
//    "00000000-6650-ef10-ffff-ffff9aab04c4",
//    "00000000-6a2b-5292-ffff-ffff9688521f",
//    "00000000-6a2b-5292-ffff-ffffe74443c9",
//    "00000000-6650-ef10-ffff-ffff89673dcf",
//    "00000000-6a2b-5292-ffff-ffffe7ed5da5",
//    "00000000-6a2b-5292-ffff-ffffed1e5850",
//    "00000000-6a2b-5292-0000-0000155dc7a6",
//    "00000000-6650-ef10-ffff-ffff89673788",
//    "00000000-6a2b-5292-ffff-ffffeaf710ed",
//    "00000000-6a2b-5292-0000-000012e3a2d2",
//    "00000000-6a2b-5292-ffff-ffffec3ce498",
//    "00000000-6a2b-5292-ffff-ffffe9eb571f",
//    "00000000-6a2b-5292-ffff-ffffb2d98966",
//    "00000000-6650-ef10-0000-0000139bd376",
//    "00000000-6a2b-5292-0000-0000155dc7a3",
//    "00000000-6a2b-5292-0000-000072b22d09",
//    "00000000-6650-ef10-ffff-ffff86ed1685",
//    "00000000-6a2b-5292-ffff-ffffe8edae6c",
//    "00000000-6a2b-5292-ffff-fffff695b7cc"
//];
//
//$deviceIds2 = [
//    "00000000-6a2b-5292-ffff-ffffeaf710ed",
//    "00000000-6a2b-5292-ffff-ffffe7ed53f5",
//    "00000000-6a2b-5292-0000-0000155dc7a6",
//    "00000000-6a2b-5292-0000-0000146022ac",
//    "00000000-6a2b-5292-0000-000012e3a2d2",
//    "00000000-6a2b-5292-ffff-ffffec3ce498",
//    "00000000-6a2b-5292-ffff-ffff9688521f",
//    "00000000-6a2b-5292-ffff-ffffe7ed5da5",
//    "00000000-6a2b-5292-0000-000039069595",
//    "00000000-6a2b-5292-ffff-ffffe8edae6c",
//    "00000000-6a2b-5292-ffff-fffff695b7cc",
//    "00000000-6a2b-5292-0000-000072b22d09",
//    "00000000-6a2b-5292-ffff-ffffcdef0822",
//    "00000000-6a2b-5292-ffff-ffff86e5a7c9",
//    "00000000-6a2b-5292-ffff-ffffe638814b",
//    "00000000-6a2b-5292-0000-00003b80b7a2",
//    "00000000-6a2b-5292-ffff-ffffe9eb571f",
//    "00000000-6a2b-5292-0000-0000155dc7a3",
//    "00000000-6a2b-5292-ffff-ffffed1e5850",
//    "00000000-6a2b-5292-ffff-ffffe74443c9",
//    "00000000-6a2b-5292-ffff-ffffb2d98966",
//    "00000000-6650-ef10-ffff-ffff86ed16a3",
//    "00000000-6650-ef10-ffff-ffff89673871",
//    "00000000-6650-ef10-ffff-ffff89673788",
//    "00000000-6650-ef10-ffff-ffff86ed1685",
//    "00000000-6650-ef10-ffff-ffff89673dcf",
//    "00000000-6650-ef10-0000-00000c8a9e06",
//    "00000000-6650-ef10-ffff-ffff9aab04c4",
//    "00000000-6650-ef10-0000-0000139bd376",
//    "00000000-6650-ef10-0000-00000aff8ff5",
//];

//public function aaa($appointTime, $periodTranslation)
//{
//    $pt = abs($periodTranslation);
//    $endDate = date('Y-m-d', strtotime("$appointTime - $pt day"));
//    $startDate = date('Y-m-d', strtotime("{$this->_endDate} - 6 day"));
//}

//$str = "个人情况与人际关系|Personal information and international relationships";
//var_dump(explode('|', $str));
//$subject = "123123|";
//list($chinese, $english) = $subject ? explode('|', $subject) : ['', ''];
//print_r($chinese);
//print_r($english);
//$url = "http://gsu-test.oss-cn-beijing.aliyuncs.com/video/不定冠词a an的用法2 _2653.mp4";
//$str = "/video/不定冠词a an的用法2 _2653.mp4";
//print_r(trim($str, '/'));


//$totalNum = 124;
//$unFamiliarNum = 5;
//$toReviewNum = 9;


//$unFamiliarRate = $totalNum ? floor($unFamiliarNum / $totalNum * 100) : 0;
//$toReviewRate = $totalNum ? floor($toReviewNum / $totalNum * 100) : 0;
//$familiarRate = $totalNum ? 100 - ($unFamiliarRate + $toReviewRate) : 0;

//var_dump($unFamiliarRate, $toReviewRate, $familiarRate);

//$onlyClassStoreIds = [];
//$result = array_diff(explode(',', $classStoreIds), explode(',', $otherStoreIds));
//print_r(implode("','",$result ));

//$a = array_fill(0,12, '');
//print_r($a);

//$b = ['你', '我'];
//$n = array_merge($b, $a);
//print_r($n);

//$a = ["1,2", "3,4"];
//print_r(implode(',', $a));

//$a = [
//    ['unit_no' => 1, 'unit_name' => 'Unit 1'],
//    ['unit_no' => 2, 'unit_name' => 'Unit 2'],
//    ['unit_no' => 3, 'unit_name' => 'Unit 1'],
//    ['unit_no' => 4, 'unit_name' => 'Unit 2'],
//];
//
//$b = ['1',2];
//$c = array_filter($a, function($v, $k) use($b) {
//    return in_array($v['unit_no'], $b);
//}, ARRAY_FILTER_USE_BOTH);
//print_r($c);



/*$a = [
    1 => ['2'],
    'ss' => ['a']
];

print_r(array_keys($a));*/

//echo "哈哈";

//$a = ['store_id' => 1];
//$b = ['store_id' => 2];
//print_r(array_merge($b, $a));

//$str = date('Y-m-d', strtotime("+6month"));
//var_dump($str);
//var_dump(!!123);//true
//var_dump(!!'123');//true
//var_dump(!!'0');//false
//var_dump(!!0);//false
//var_dump(!!null);//false
//var_dump(!!'');//false
//var_dump(!![]);//false
//var_dump(!!['']);//true

/*$storeData = [
    ['store_id' => 1, 'supporter_id' => 1, 'supporter' => '运营1'],
    ['store_id' => 2, 'supporter_id' => 2, 'supporter' => '运营2'],
    ['store_id' => '', 'supporter_id' => 3, 'supporter' => '运营3'],
];

$storeData = array_filter($storeData, function ($value) {
    return !!$value['store_id'];
});

print_r($storeData);*/

//class A {
//    public $_name;
//
//    public function __construct($name)
//    {
//        $this->_name = $name;
//    }
//}
//
//$aaa = new A("aaa");
//$bbb = new A("ccc");
//unset($aaa->_name);
//var_dump($aaa);
//var_dump($bbb);

/*$a = [
    ['id' => 1, 'name' => '1'],
    ['id' => 2, 'name' => '2'],
    ['id' => 3, 'name' => '3'],
    ['id' => 4, 'name' => '4'],
];

foreach ($a as $key => $item) {
    if ($key = 2) {
        $a[1]['name'] = '许磊';
    }
}

var_dump($a);*/

/*class AAA {
    public static function ss()
    {
        echo __CLASS__ ;
    }
}

AAA::ss();*/
/*$username = "a1111";
if (!preg_match("/^[a-zA-Z][a-zA-Z0-9]{5,12}$/", $username)) {
    echo "错了";
} else {
    echo "对了";
}*/

//$username = "z";
//$result = !!preg_match("/^[a-zA-Z][a-zA-Z0-9]{-1,12}$/", $username);
//var_dump($result);

//$expire = strtotime(date('Y-m-d 03:00:00', strtotime("+1 day"))) - time();
//var_dump($expire/3600);
//
//function rrr($words)
//{
//    $randomKeys = array_rand($words, 3);
//    $allWord = $words;
//    return array_map(function($item) use ($allWord){
//        return $allWord[$item];
//    }, $randomKeys);
//}

$arr = ['I', 'Like', 'apple'];
//shuffle($arr);
//$r1 = array_rand($arr, 1);
//$r1 = rrr($arr);
//shuffle($arr);
//$r2 = array_rand($arr, 1);
//$r2 = rrr($arr);
//shuffle($arr);
//$r3 = array_rand($arr, 1);
//$r3 = rrr($arr);

//var_dump($r1);
//var_dump($r2);
//var_dump($r3);

//var_dump($arr[$r1]);
//var_dump($arr[$r2]);
//var_dump($arr[$r3]);

//$a = [1,2,3,4];
//foreach ($a as $b) {
//    echo "之前的值：{$c}:\n";
//    if ($b == 1) {
//        $c = "哈哈";
//    }
//    echo "之后的值：{$c}:\n";
//
//}

//$a = range(0,35);
//for (;;) {
//}
//
//foreach ($a as $k => $item) {
//    $k += 1;
//    echo $k . "秒\n";
//    sleep(1);
//}

//$str = "2.45";
//var_dump(is_numeric($str));

//$a = [0,'0',false, null, '','012',-1];
//$v = implode(',',array_filter($a));
//var_dump($v);

//var_dump("1,2" == 1);
//var_dump("1,2" == "1");

//$week = intval(date('W',time()));
//var_dump($week);

//var_dump(empty('0'));
//var_dump(empty(0));

class AAA {

}

class BBB {
    public function ccc(AAA $a){
        var_dump($a);
    }
}

$b = new BBB();
$b->ccc(null);