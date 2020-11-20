<?php
require_once('../inc/db_class.php');
require_once('../inc/config.php');
$connection = new dbController(HOST,USER,PASS,DB,PORT);//use $conn to retrive the return object.
//$sql = "select id,open,concat(left(24hChange*100,4),'%') as 24change,concat(left(7dChange*100,4),'%') as 7dchange,concat(left(30dChange*100,4),'%') as 30dchange,volume,marketCap from crypto_historical_data order by marketCap desc";
// $sql = "select id,date,currency,open,concat(left(24hChange*100,4),'%') as 24change,concat(left(7dChange*100,4),'%') as 7dchange,concat(left(30dChange*100,4),'%') 
// as 30dchange,volume,marketCap,T2.rownum as rank,avg(open)
// from crypto_historical_data join (select T1.marketCap as MktCap,(@rownum:=@rownum+1) as rownum from (select distinct marketCap 
// from crypto_historical_data
// order by marketCap desc) as T1,(select @rownum:=0) as R) as T2 on crypto_historical_data.marketCap=T2.MktCap
// group by date,id,currency,24change,7dchange,30dchange,volume,marketCap,rank
// order by crypto_historical_data.marketCap DESC";

$sql = "select id,date,currency,open,concat(left(24hChange*100,4),'%') as 24change,concat(left(7dChange*100,4),'%') as 7dchange,concat(left(30dChange*100,4),'%') 
as 30dchange,volume,marketCap,avg(open) from crypto_historical_data
group by date,id,currency,24change,7dchange,30dchange,volume,marketCap
order by marketCap desc";



$result = $connection->executeResult($sql);
$title='father_module';
?>

<?php include ('inc/header.inc.php');?>
<div id="main" style="height:1000px;">
	<div class="title">Super module list</div>
		<table class="list">
			<tr>
			    <th>Date</th>
				<th>Currency</th>
				<th>Price</th>	 	 	
				<th>24h Change</th>
				<th>7d Change</th>
				<th>30d Change</th>
				<th>24h Volume</th>
				<th>Market Cap</th>
			</tr>
			<?php
			//while($data = mysqli_fetch_assoc($result)){
			foreach($result as $data){
				//每取出一行关联数组，就按照一下格式输出相应的数据。
				//点击链接时，跳转到确认页面，但是需要将$data数据传递到最终到删除页面，就需要通过两个变量将url地址封装
				//使用urlencode是因为，链接传递数据时会出现两个？，这样会造成服务器混淆，所以对url进行加密，通过GET数组取时
				//不需要解密，因为GET自动解密。
			$url=urlencode("delete.php?id={$data['id']}");//将此url封装
			$return_url=urlencode($_SERVER['REQUEST_URI']);//当前地址封装
			$message="Are you sure you want to delete this module {$data['module_name']}";
			$delete_url="delete_confirm.php?url={$url}&return_url={$return_url}&message={$message}";
$html = <<<A
			<tr>
				<td>{$data['date']}</td>
				<td>{$data['currency']}</td>
				<td>\${$data['open']}</td>
				<td>{$data['24change']}</td>
				<td>{$data['7dchange']}</td>
				<td>{$data['30dchange']}</td>
				<td>\${$data['volume']}</td>
				<td>\${$data['marketCap']}</td>
				<td><a href="father_module_access.php">Access</a>&nbsp;&nbsp;<a href="father_module_update.php?id={$data['id']}">Update</a>&nbsp;&nbsp;<a href="$delete_url">Delete</a></td>
			</tr>
A;
				echo $html;
}
			?>
		</table>
	</div>
<?php include 'inc/footer.inc.php';?>
