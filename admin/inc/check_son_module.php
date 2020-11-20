<?php
	if(!($_POST['father_module_id'])){
		skip('son_module_add.php','error','Sorry, related father module can not be empty!');
    }
    $query2="select * from sfk_father_module where id='{$_POST['father_module_name']}'";
    $result2=$connection->executeResult($query2);
    if($result2->num_rows){
        skip('son_module_add.php','error','Sorry, the related super module does not exist!');
    }
    if(empty($_POST['module_name'])){
		skip('son_module_add.php','error','Sorry, sub module_name can not be empty!');
	}
	if(mb_strlen($_POST['module_name'])>66){
		skip('son_module_add.php','error','Sorry, sub module_anme must less than 66 characters!');
	}
    $_POST=$connection->escape($_POST);
    switch($check_flag){
        case 'add':
            $query1="select * from sfk_son_module where module_name='{$_POST['module_name']}'";
            //如果数据库中可以找到与输入module—name重复的名字，则break，执行skip语句
            break;
        case 'update':
            $query1="select * from sfk_father_module where module_name='{$_POST['module_name']}' and id!={$_GET['id']}";
            //更改时，是更改当前id下的值，所以如果不是这样子，就不是数据更新。
            break;
        default:
            skip('son_module_add.php','error','$check_flag');
    }

 
	//sql 语句中的变量，最好都加上转义语句或者函数，这样单引号，双引号，这些就可以输出

    $result1=$connection->executeResult($query1);
	if($result1->num_rows){
	    skip('son_module_add.php','error','Sorry, this sub module already existed');
    }
    if(mb_strlen($_POST['info'])>255){
		skip('son_module_add.php','error','Sorry, the number of characters should less than 255!');
    }
    if(!is_numeric($_POST['sort'])){
		skip('son_module_add.php','error','Sorry, sort only input by number!');
	}
?>
