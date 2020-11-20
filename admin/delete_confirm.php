<?php
require_once('../inc/db_class.php');
require_once('../inc/config.php');
//$connection = new dbController(HOST,USER,PASS,DB,PORT);//use $conn to retrive the return object.
if(!isset($_GET['message']) || !isset($_GET['url']) || !isset($_GET['return_url'])){
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>confirm to delete</title>
<meta name="keywords" content="confirm to delete" />
<meta name="description" content="confirm to delete" />
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice"><span class="pic ask"></span> <?php echo "{$_GET['message']}";?> <a style="color:red;" href="<?php echo "{$_GET['url']}";?>">Yes</a> | <a style="color:green;" href="<?php echo $_GET['return_url'];?>">Cancel</a></div>
</body>
</html>

