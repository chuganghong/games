<?php
/**
 *采集flash文件地址，并下载flash文件
 */
require(dirname(dirname($_SERVER['SCRIPT_FILENAME'])) . '/admin/model/DB.class.php');
$url = 'http://huanzhuang.973.com/p63895';
$str = file_get_contents($url);
#var flash_url = 'http://flash.973.com/1304/134625/13670477433.swf'
$pattern = '#http://(.*?)\.swf#';
$pattern = "/var\s*?flash_url\s*?=\s*?'(.*?\.swf)'/i";
preg_match_all($pattern,$str,$matches);
var_dump($matches);
echo $matches[1][0];
$flash = $matches[1][0];
$data = file_get_contents($flash);
$filename = basename($flash);
var_dump($filename);
//file_put_contents($filename,$data);