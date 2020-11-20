<?php
require_once('../inc/db_class.php');
require_once('../inc/config.php');
require_once('../inc/tool.inc.php');
$connection = new dbController(HOST,USER,PASS,DB,PORT);//use $conn to retrive the return object.
// $sql = "select * from sfk_father_module";
// $result = $connection->executeResult($sql);
$title='son_module_add'; 
//var_dump($_POST);exit();


if(isset($_POST['submit'])){
	
	$check_flag='add';
	include('inc/check_son_module.php');
	
	$query="insert into sfk_son_module(father_module_id,module_name,info,member_id,sort) values({$_POST['father_module_id']},'{$_POST['module_name']}','{$_POST['info']}',{$_POST['member_id']},{$_POST['sort']})";
	//echo $query;
	$connection->executeResult($query);
	if($connection->conn->affected_rows==1){
		skip('son_module.php','ok','Congradulations! Data added successfully');
	}else{
		skip('son_module_add.php','error','Sorry, data added failed!');
	}
	exit();
}
?>


<?php include ('inc/header.inc.php');?>
<div id="main">
	<div class="title" style="margin-bottom:20px;">Add sub module</div>	
	<form method="post">
		<table class="au">
			<tr>
				<td>Super Module Name</td>
				<td>	
					<select name="father_module_id">
						<option value="0">===please choose one super module===</option>
						<?php
							$query="select * from sfk_father_module";
							$result_father=$connection->executeResult($query);
							foreach($result_father as $row){
								echo "<option value='{$row['id']}'>{$row['module_name']}</option>";
							}
						?>
					</select>
				</td>
				<td>
					You must choose one related super module.
				</td>
			</tr>	
			<tr>
				<td>Module Name</td>
				<td><input name="module_name" type="text" /></td>
				<td>
					The module name can't be empty, and the size must less than 66
				</td>
			</tr>
			<tr>
				<td>Desription</td>
				<td>
					<textarea name="info"></textarea>
				</td>
				<td>
					Description can not more than 255.
				</td>
			</tr>
			<tr>
				<td>Module hoster</td>
				<td>	
					<select name="member_id">
						<option value="0">===please choose one member as hoster===</option>
					</select>
				</td>
				<td>
					You could choose one member as the hoster.
				</td>
			</tr>
			<tr>
				<td>Sort</td>
				<td><input name="sort" type="text" /></td>
				<td>
					One number is advisiable.
				</td>
			</tr>
		</table>
		<input style="margin_top:20px; cursor:pointer;" class="btn" type="submit" name="submit" value="Submit"/>
	</form>
</div>
<?php include 'inc/footer.inc.php';?>
