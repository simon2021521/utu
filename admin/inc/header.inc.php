
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php echo $title?></title>
<meta name="keywords" content="后台界面" />
<meta name="description" content="后台界面" />
<link rel="stylesheet" type="text/css" href="style/public.css" />
</head>
<body>
	<div id="top">
		<div class="logo">
			Data Control Center
		</div>
		<ul class="nav">
			<li><a href="http://www.sifangku.com" target="_blank">UTU</a></li>
			<li><a href="http://www.sifangku.com" target="_blank">UTU</a></li>
		</ul>
		<div class="login_info">
			<a href="#" style="color:#fff;">HomePage</a>&nbsp;|&nbsp;
			Administrator： admin <a href="#">[Log Out]</a>
		</div>
	</div>
	<div id="sidebar">
		<ul>
			<li>
				<div class="small_title">System</div>
				<ul class="child">
					<li><a href="#">System Information</a></li>
					<li><a href="#">Administrator</a></li>
					<li><a href="#">Member</a></li>
					<li><a href="#">Setting</a></li>
				</ul>
			</li>
			<li><!--  class="current" -->
				<div class="small_title">Admin</div>
				<ul class="child">
					
					<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='father_module.php'){echo 'class="current"';}?> href="father_module.php">Top 100 Coins</a></li>
					<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='father_module_add.php'){echo 'class="current"';}?> href="father_module_add.php">Add Coins</a></li>
					<?php 
					if(basename($_SERVER['SCRIPT_NAME'])=='father_module_update.php'){
						echo '<li><a class="current">Editing Coins</a></li>';
					}
					?>
					<li><a href="#">XXX</a></li>
					<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='son_module_add.php'){echo 'class="current"';}?> href="son_module_add.php">XXX</a></li>
					<li><a href="#">XXX</a></li>
				</ul>
			</li>
			<li>
				<div class="small_title">User Admin</div>
				<ul class="child">
					<li><a href="#">User List</a></li>
				</ul>
			</li>
		</ul>
	</div>

