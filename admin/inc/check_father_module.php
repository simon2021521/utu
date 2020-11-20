<?php

    if(empty($_POST['currency_name'])){
		skip('father_module_add.php','error','Sorry, currency_name can not be empty!');
	}
	if(mb_strlen($_POST['currency_name'])>30){
		skip('father_module_add.php','error','Sorry, module_anme must less than 30 characters!');
	}
    if(!is_numeric($_POST['price'])){
		skip('father_module_add.php','error','Sorry, please check your open price, where number is expected!');
    }
    if(!is_numeric($_POST['high'])){
		skip('father_module_add.php','error','Sorry, please check your high price, where number is expected!');
    }
    if(!is_numeric($_POST['low'])){
		skip('father_module_add.php','error','Sorry, please check your low price, where number is expected!');
    }
    if(!is_numeric($_POST['close'])){
		skip('father_module_add.php','error','Sorry, please check your close price, where number is expected!');
    }
    if(!is_numeric($_POST['volume'])){
		skip('father_module_add.php','error','Sorry,please check your volume, where number is expected!');
    }
    if(!is_numeric($_POST['marketcap'])){
		skip('father_module_add.php','error','Sorry, please check your market cap, where number is expected!');
    }
    if(!is_numeric($_POST['24hchange'])){
		skip('father_module_add.php','error','Sorry, please check your 24h change difference, where number is expected,if there is no date currently, please input 0.0');
    }
    if(!is_numeric($_POST['7dchange'])){
		skip('father_module_add.php','error','Sorry, please check your 7d change difference, where number is expected,if there is no date currently, please input 0.0');
    }
    if(!is_numeric($_POST['30dchange'])){
		skip('father_module_add.php','error','Sorry, please check your 30d change difference, where number is expected,if there is no date currently, please input 0.0');
	}
    $_POST=$connection->escape($_POST);
    switch($check_flag){
        case 'add':
            $query1="select * from crypto_historical_data where date='{$_POST['date']}' and currency='{$_POST['currency_name']}'";
            //如果数据库中可以找到与输入currency—name和日期都重复，则break，执行skip语句(说明数据重复)
            break;
        case 'update':
            $query1="select * from crypto_historical_data where date='{$_POST['date']}' and currency='{$_POST['currency_name']}' and id!={$_GET['id']}";
            //更改时，是更改当前id下的值，所以如果不是这样子，就不是数据更新。
            break;
        default:
            skip('father_module_add.php','error','$check_flag');
    }
	//sql 语句中的变量，最好都加上转义语句或者函数，这样单引号，双引号，这些就可以输出

    $result1=$connection->executeResult($query1);
	if($result1->num_rows){
	    skip('father_module_add.php','error','Sorry, data repeated');
	}
?>
