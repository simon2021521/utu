<?php
require_once('../inc/db_class.php');
require_once('../inc/config.php');
require_once('../inc/tool.inc.php');
$connection = new dbController(HOST,USER,PASS,DB,PORT);//use $conn to retrive the return object.

$title='father_module_add'; 



if(isset($_POST['submit'])){
	$check_flag='add';
	include('inc/check_father_module.php');
	
	$query="insert into crypto_historical_data(currency,date,open,high,low,close,volume,marketCap,24hChange,7dChange,30dChange) values('{$_POST['currency_name']}','{$_POST['date']}',
	{$_POST['price']},{$_POST['high']},{$_POST['low']},{$_POST['close']},{$_POST['volume']},{$_POST['marketcap']},{$_POST['24hchange']},{$_POST['7dchange']},{$_POST['30dchange']})";

	$connection->executeResult($query);
	if($connection->conn->affected_rows==1){
		skip('father_module.php','ok','Congradulations! Data added successfully');
	}else{
		skip('father_module_add.php','error','Sorry, data added failed!');
	}
	exit();
}
?>

<?php include ('inc/header.inc.php');?>
<div id="main">
	<div class="title" style="margin-bottom:20px;">Add super module</div>	
	<form method="post">
		<table class="au">
			<tr>
				<td>Currency</td>
				<td><input name="currency_name" type="text" /></td>
				<td>
					The module name can't be empty, and the size must less than 30
				</td>
			</tr>
			<tr>
				<td>Price</td>
				<td><input name="price" type="text" /></td>
				<td>
					The module name can't be empty, and the size must less than 66
				</td>
			</tr>
			<tr>
				<td>Date</td>
				<td><input name="date" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>High</td>
				<td><input name="high" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>Low</td>
				<td><input name="low" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>Close</td>
				<td><input name="close" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>volume</td>
				<td><input name="volume" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>MarketCap</td>
				<td><input name="marketcap" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>24hChange</td>
				<td><input name="24hchange" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>7dChange</td>
				<td><input name="7dchange" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>30dChange</td>
				<td><input name="30dchange" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
		</table>
		<input style="margin_top:20px; cursor:pointer;" class="btn" type="submit" name="submit" value="Submit"/>
	</form>
</div>
<?php include 'inc/footer.inc.php';?>
