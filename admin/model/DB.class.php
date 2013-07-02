<?php
/**
 *数据库操作类
 */
interface InsertOperation
{
	public function insert();
}

abstract class DataTables
{
	protected $db;
	
	public function __set($name,$value)
	{
		$this->$name = $value;
	}
	
	public function __get($name)
	{
		return $this->$name;
	}
	
	
	
	/**
	 *过滤数据，防止SQL注入
	 *@param mix $input 输入数据
	 *@return mix $input 经过过滤后的$input
	 */
	public function _filter($input)
	{
		return mysql_real_escape_string(trim($input));
	}
}

class InsertTopic extends DataTables implements InsertOperation
{
	protected $names;
	protected $urls;	
	
	public function insert()
	{	
		for($i=1;$i<=13;$i++)
		{
			$name1 = $this->names[$i];
			$url1 = $this->urls[$i];
			$name = $this->_filter($name1);
			$url = $this->_filter($url1);
			
			$sql = "INSERT INTO topic (name,url) VALUES ('{$name}','{$url}')";
			$this->db->_query($sql);
		}
	}
}

class InsertGame extends DataTables implements InsertOperation
{
	protected 

class DB
{
	protected $con;
	protected $result;
	
	public function __construct($host,$root,$pwd,$db)
	{
		$this->con = mysql_connect($host,$root,$pwd) or die('Could not connect ' . $host . ':' . mysql_error());
		mysql_select_db($db,$this->con) or die('Could not use ' . $db);
	}
	
	/**
	 *获取DB类的property
	 *@param string $name property
	 */
	function __get($name)
	{
		return $this->$name;
	}
	
	/**
	 *发送SQL语句
	 *@param string $sql SQL语句
	 */
	function _query($sql)
	{
		mysql_query('SET NAMES UTF8');
		$this->result = mysql_query($sql,$this->con) or die('"' . $sql . '" error:' . mysql_error());
	}
}