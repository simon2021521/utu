<?php
//connect the database
class dbController {
	public $conn;//mysqli 只是dbController的一个属性，还有其他属性（方法或函数也可以看作属性）包含在其中，dbController的对象不可以使用mysqli
	//对象中的方法
	
	public function __construct($host,$user,$pass,$db,$port) {//创建类dbController的构造函数
		$this->conn = @new mysqli(//使用new关键字调用mysqli的构造函数，在类的任意方法内，使用当前类的成员变量或成员方法可在
			//其前面加this，增强程序可读性。this实质上是指上下文对象，在类内访问都需要加上this。
			$this->host = $host,//$this指的也是this->conn连接对象
			$this->user = $user,//$this->host（mysqli对象的成员变量即属性）= $host（形参）.
			$this->pass = $pass,
			$this->db = $db,
			$this->port = $port);
		if($this->conn->connect_errno) {
			exit($this->conn->connect_error);
		}
		// else{
		// echo 'Connection Successful';
		// }
		mysqli_set_charset($this->conn,'utf-8');
		return $this->conn;
	}
//execute one sql statement, return boolean
	public function executeQuery($sql) {
		$result = $this->conn->query($sql);
		//var_dump($this->conn->errno);
		if($this->conn->errno){
			exit($this->conn->error);
		}else{
			return true;
		}
	}

//execute one sql statement, only return result
	public function executeResult($sql) {
		$result = $this->conn->query($sql);//返回结果集对象，
		//var_dump($this->conn->errno);
		if($this->conn->errno){
			exit($this->conn->error);
		}else{
			return $result;
		}
	}
//execute many statements in one time
	/*
 一次性执行多条SQL语句
$link：连接
$arr_sqls：数组形式的多条sql语句
$error：传入一个变量，里面会存储语句执行的错误信息
使用案例：
$arr_sqls=array(
	'select * from sfk_father_module',
	'select * from sfk_father_module',
	'select * from sfk_father_module',
	'select * from sfk_father_module'
);
var_dump(execute_multi($link, $arr_sqls,$error));
echo $error;
*/
	function execute_multi($link,$arr_sqls,&$error){
		$sqls=implode(';',$arr_sqls).';';
		if(mysqli_multi_query($link,$sqls)){
			$data=array();
			$i=0;//计数
			do {
				if($result=mysqli_store_result($link)){
					$data[$i]=mysqli_fetch_all($result);
					mysqli_free_result($result);
				}else{
					$data[$i]=null;
				}
				$i++;
				if(!mysqli_more_results($link)) break;
			}while (mysqli_next_result($link));
			if($i==count($arr_sqls)){
				return $data;
			}else{
				$error="sql语句执行失败：<br />&nbsp;数组下标为{$i}的语句:{$arr_sqls[$i]}执行错误<br />&nbsp;错误原因：".mysqli_error($link);
				return false;
			}
		}else{
			$error='执行失败！请检查首条语句是否正确！<br />可能的错误原因：'.mysqli_error($link);
			return false;
		}
	}
	

//require the numbers of record
	public function num($sql_count){
		$result = $this->executeResult($sql_count);
		$row = $result->fetch_row();
		return $row[0];
		
	}
//transfer the data before enter database, make sure all date import database successfully
	public function escape($data){
		if(is_string($data)){
			return $this->conn->real_escape_string($data);//escape special characters in a string for use in an SQL statement.
		}elseif(is_array($data)){
			foreach($data as $key=>$row){
				$data[$key] = $this->escape($row);
		}
		}
		return $data;			
	}
//不断地拆分数组，取出元素，直到所有元素都被转义，然后返回转义后的内容。这样就会确保所有内容都会得到转义输出
//turn off the database
	public function close(){
		$this->conn->close();
	}
}
?>