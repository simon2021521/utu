<?php
function skip($url,$pic,$hint){
$html=<<<A
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="refresh" content="3; URL={$url}"/>
<title>Recongnizing</title>
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice"><span class="pic {$pic}"></span> {$hint} would skip automatically in 3 seconds...</div>
</body>
</html>
A;
echo $html;
exit ();//调用此函数后，就会终止程序，以防止调用函数后，在其之后的代码执行。
//先运行php代码，然后传递到浏览器解析，所有数据输入成功，会先跳转到新的网址，然后重新加载html
}
?>