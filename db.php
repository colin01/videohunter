<?php

//数据表操作 insert update delete select max min avg sum count like 
///cache  cache_init  cache_drop  get set 
//create drop  complex_select 

class dbhelper
{

	public $debug=false;

	function __construct($cfg,$debug)
	{
		($coon=@mysql_connect("{$cfg['db_host']}:{$cfg['db_port']}",$cfg['db_user'],$cfg['db_pass'],true))||exit('数据库连接失败:'.mysql_error());
		mysql_select_db($cfg['db_name'],$coon)||exit('数据库选择失败:'.mysql_error());
		mysql_query("SET NAMES utf8");
		if ($debug)
		{
			$this-> debug=$debug;
		}
	}

	function query($query)
	{
		if($this-> debug)
		{
			exit($query);
		}
		else
		{

			$result=mysql_query($query);
			return $result;
		}

	}

	function insert($table,$data)
	{

		foreach ($data as $key => $value) 
		{
			
			$k[]='`'.$key.'`';
			$v[]='"'.$value.'"';

		}

		$strv.=implode(',',$v);     
   		$strk.=implode(",",$k);
		
		$sql="INSERT INTO {$table} ({$strk}) VALUES ({$strv})";
		$result=$this->query($sql);
		return $result;

	}
	function update($table,$where,$data)
	{
		foreach ($data as $key => $value) 
		{
			
			$v[]=$key.'='."'".$value."'";
			

		}
		$strv.=implode(',',$v);   

		foreach ($where as $key => $value) 
		{
			
			$k[]='(`'.$key.'`="'.$value.'")';
			

		}

		
   		$strk.=implode("and",$k);
		  
   		$sql="UPDATE {$table} SET {$strv} WHERE ({$strk})";
   		$result=$this->query($sql);
   		return $result;

	} 
	function delete($table,$where)
	{
		foreach ($where as $key => $value) 
		{
			
			$k[]='(`'.$key.'`="'.$value.'")';
			

		}

		
   		$strk.=implode("and",$k);

		
		$result = $this ->query("DELETE FROM {$table} WHERE ({$strk})");  
		return $result;

	}
	function select($table,$where=null,$column='*')
	{
		if(empty($where))
		{

			$string="SELECT {$column} FROM {$table}";
		}
		else
		{
			foreach ($where as $key => $value) 
			{
			
				$k[]='(`'.$key.'`="'.$value.'")';

			}
			$strk.=implode("and",$k);
			$string="SELECT {$column} FROM {$table} WHERE ({$strk})";
		}
		
   		
		$result = $this ->query($string);
		
		while ($arr=mysql_fetch_array($result))
		{
			$output[]=$arr;
		}
		return $output;

	}
	function complex_select()
	{

	}
	function max($table,$column)
	{
		$sql="select max({$column}) from {$table}";
		$result=$this->query($sql);
		return mysql_fetch_array($result);

	}
	function min($table,$column)
	{
		$sql="select min({$column}) from {$table}";
		$result=$this->query($sql);
		return mysql_fetch_array($result);

	}
	function avg($table,$column)
	{
		$sql="select avg({$column}) from {$table}";
		$result=$this->query($sql);
		return mysql_fetch_array($result);
	}
	function sum($table,$column)
	{
		$sql="select sum({$column}) from {$table}";
		$result=$this->query($sql);
		return mysql_fetch_array($result);
	}
	function count($table,$column="*")
	{
		$sql="select count({$column}) from {$table}";
		$result=$this->query($sql);
		return mysql_fetch_array($result);

	}
	function isin($table,$where)
	{
		foreach ($where as $key => $value) 
		{
			
			$k[]='(`'.$key.'`="'.$value.'")';
			

		}

		
   		$strk.=implode("and",$k);
		  
   		$sql="select * from {$table}  WHERE ({$strk})";
   		$result=$this->query($sql);
   		return $result;

	}
	function like()
	{

	}
	function create($table,$struct)
	{

		//$this->check($struct);
		foreach ($struct as $key => $value)
		{
			$v[]="`".$key."`".' '.$value;
		}
		$strv.=implode(',',$v);  
		$sql="CREATE TABLE IF NOT EXISTS {$table} ({$strv})";
		$result=$this->query($sql);
		return $result;

	}
	function drop($table)
	{
		$sql="DROP TABLE IF EXISTS {$table}";
		$result=$this->query($sql);
		return $result;

	}
	function cache_init($size=1)
	{

		switch ($size)
		{
			case '1':
				$size='varchar(100)';
				break;
			case '2':
				$size='text';
				break;
			case  '3':
				$size='blob';
				break;
		}
			$struct=array('i'=>'int NOT NULL AUTO_INCREMENT PRIMARY KEY',
				'k'=>'char(10) NOT NULL',
				'v'=>"{$size} NOT NULL");

			$result=$this->create('cache',$struct);
			return $result;
		

	}
	function cache_drop()
	{
		return $this->drop('cache');
	}
	function get($key)
	{
		
		$where=array('k'=>$key);
		$result=$this->select('cache',$where,'v');	
		return $result[0]['v'];

	}
	function set($key,$value)
	{
		$where=array('k'=>$key);
		$data=array('k'=>$key,'v'=>$value);
		if (empty($value)) //shanchu 
		{
			$result=$this->delete('cache',$where);
			return $result;
		}
		else
		{
			$result=$this->isin('cache',$where);
			if ($rwsult)//存在则更新
			{
				$result=$this->update('cache',$where,$data);
				return $result;
			}
			else
			{
				$result=$this->insert('cache',$data);
				return $result;
			}

		}
	}

	function __destruct()
	{
		mysql_close();
	}
}
///end class db

$cfg=array('db_host'=>'localhost',
			'db_user'=>'root',
			'db_pass'=>'123456',
			'db_name'=>'app_173aft');

$db=new dbhelper($cfg,0);




//test 
///  select insert update delete set get max count sum   caeate drop  cache_drop cache_init
///
$where=array('work'=>'1');
$data=array('sname'=>'su','spass'=>"111552",'semail'=>'444556');
//$result=$db->count('sell','point');
//$struct=array('id'=>'int NOT NULL');
$result=$db->select('sell',$where);
var_dump($result);