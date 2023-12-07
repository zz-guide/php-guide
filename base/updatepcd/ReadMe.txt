1.首先到百度地图的资源网站下载最新的省市区行政EXCEL
地址：http://lbsyun.baidu.com/index.php?title=open/dev-res
2. 将表头的名称改成数据库字段
3.通过在线网站excel转json，将数据转化为json，类似于[{"province":"山西省","city":"太原市","district":"小店区"}]这种格式
地址：http://www.esjson.com/jsontoexcel.html
4.然后针对2020baidumap.json的数据进行解析，先与旧的2018baidumap.json的数据进行互相比对，找出 在2018不在2020的，在2020不在2018的数据



5.可以把excel整个数据入库