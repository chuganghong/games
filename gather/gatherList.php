<?php
/**
 *采集游戏列表数据：小缩略图、包含flash文件的页面URL、游戏简介、游戏标签
 */
require(dirname(dirname($_SERVER['SCRIPT_FILENAME'])) . '/admin/model/DB.class.php');
$url = 'http://www.973.com/xiuxian';
$str = file_get_contents($url);
//$pattern = '/<ul id="lsf01" class="game_dd">([^(ul)]*?)<\/ul>/i';
$pattern1 = '/<ul\s*?id="lsf01"\s*?class="game_dd"\s*?>(.*?)<\/ul>/i';
$pattern = '/<li>(.*?)<\/li>/i';
preg_match_all($pattern,$str,$matches);
//var_dump($matches);
$needle = '<div class="page">';
$str1 = strstr($str,$needle,true);
//var_dump($str1);
//echo $str1;
$needl2 = '<ul id="lsf01" class="game_list">';
$str2 = strstr($str1,$needl2);
//var_dump($str2);
$pattern = '/<p>(.*?)<\/p>/i';
preg_match_all($pattern,$str2,$matches);
//var_dump($matches);
//echo $matches[1][0];
//file_put_contents('log.txt',$matches[1][1]);
$pattern3 = '#<b><a\s*?href="(.*?)">(.*?)<\/a><\/b>#i';
preg_match_all($pattern3,$matches[1][1],$matches2);
//var_dump($matches2);
$pattern4 = '#<i\s*?class="brief">(.*?)<\/i>#i';
preg_match_all($pattern4,$matches[1][6],$matches3);
//var_dump($matches3);

foreach($matches[1] as $v)
{
	$pattern3 = '#<b><a\s*?href="(.*?)">(.*?)<\/a><\/b>#i';//页面url、游戏名称
	preg_match_all($pattern3,$v,$matches2);
	var_dump($matches2);
	$pattern4 = '#<i\s*?class="brief">(.*?)<\/i>#i';//游戏简介
	preg_match_all($pattern4,$v,$matches3);
	var_dump($matches3);
	//echo '<hr>';
	$pattern5 = '#<i\s*?class="tag1">.*?(<a\s*?href=".*?">.*?<\/a>)?\s*?<\/i>#i';//游戏标签
	preg_match_all($pattern5,$v,$matches4);
	var_dump($matches4);
	echo '<hr>';
}
