<?php
/**
 *采集栏目数据
 */
 $path = set_include_path(get_include_path() . PATH_SEPARATOR . dirname(dirname($_SERVER['SCRIPT_FILENAME']))) . '/db';
 var_dump($path);
 
require(dirname(dirname($_SERVER['SCRIPT_FILENAME'])) . '/admin/model/DB.class.php');

$pattern = '/<div\s*?class="menu">(.*?)<\/div>/';
$url = 'http://www.973.com/';
$str = file_get_contents($url);
if(preg_match($pattern,$str,$matches))
{
	var_dump($matches);
}
$pattern2 = '/<li><a\s*?href="(.*?)".*?>(.*?)<\/a><\/li>/i';
if(preg_match_all($pattern2,$matches[1],$matches2))
{
	echo 'strftime()<br />';
	var_dump($matches2);
}

$db = new DB('localhost','root','','microgames');
$names = $matches2[2];
$urls = $matches2[1];
$it = new InsertTopic();
$it->__set('db',$db);
$it->__set('names',$names);
$it->__set('urls',$urls);
$it->insert();

	