<?php
require_once('../inc/db_class.php');
require_once('../inc/config.php');
require_once('../inc/tool.inc.php');
$title='father_module_update'; 
$connection = new dbController(HOST,USER,PASS,DB,PORT);//use $conn to retrive the return object.
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('father_module.php','error','Sorry, you inputted wrong parameter');
}//首先判断传递过来id或是否是数字字符串，如果没有，则弹出输入错误
$sql = "select * from crypto_historical_data where id={$_GET['id']}";
$result = $connection->executeResult($sql);

 if(!$result->num_rows){
	skip('father_module.php','error','Sorry, this moudle does not exist');
 }//传入的id不存在（手动输入id情况下），弹出错误。
 if(isset($_POST['submit'])){
	 $check_flag='update';
	 include('inc/check_father_module.php');

	 $sql="update crypto_historical_data set currency='{$_POST['currency_name']}',date='{$_POST['date']}',open={$_POST['price']},high={$_POST['high']},
	 low={$_POST['low']},close={$_POST['close']},volume={$_POST['volume']},marketCap={$_POST['marketcap']},24hChange={$_POST['24hchange']},
	 7dChange={$_POST['7dchange']},30dChange={$_POST['30dchange']} where id={$_GET['id']}";

	 $result=$connection->executeResult($sql);

	 if($connection->conn->affected_rows==1){
		 skip('father_module.php','ok','Modify successfully');
	 }else{
		 skip('father_module.php','error','Modify failed, please try again');
	 }
 }
$data=$result->fetch_assoc();
?>

<?php include ('inc/header.inc.php');?>
<div id="main">
	<div class="title" style="margin-bottom:20px;">Update super module -<?php echo $data['module_name']?></div>	
	<form method="post">
	<!-- post 提交到本页 -->
		<table class="au">
			<tr>
				<td>Currency</td>
				<td><input name="currency_name" value="<?php echo $data['currency']?>" type="text" /></td>
				<td>
					The module name can't be empty, and the size must less than 30
				</td>
			</tr>
			<tr>
				<td>Price</td>
				<td><input name="price" value="<?php echo $data['open']?>" type="text" /></td>
				<td>
					The module name can't be empty, and the size must less than 66
				</td>
			</tr>
			<tr>
				<td>Date</td>
				<td><input name="date" value="<?php echo $data['date']?>" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>High</td>
				<td><input name="high" value="<?php echo $data['high']?>" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>Low</td>
				<td><input name="low" value="<?php echo $data['low']?>" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>Close</td>
				<td><input name="close" value="<?php echo $data['close']?>" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>volume</td>
				<td><input name="volume" value="<?php echo $data['volume']?>" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>MarketCap</td>
				<td><input name="marketcap" value="<?php echo $data['marketCap']?>" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>24hChange</td>
				<td><input name="24hchange" value="<?php echo $data['24hChange']?>" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>7dChange</td>
				<td><input name="7dchange" value="<?php echo $data['7dChange']?>" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
			<tr>
				<td>30dChange</td>
				<td><input name="30dchange" value="<?php echo $data['30dChange']?>" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
		</table>
		<input style="margin_top:20px; cursor:pointer;" class="btn" type="submit" name="submit" value="Modify"/>
	</form>
</div>
<?php include 'inc/footer.inc.php';?>
