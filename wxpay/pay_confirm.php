<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>确认付款</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="../assets/front/css/pay_confirm.css">
</head>
<body>
<?php
	$project = $_GET['pro'];
	$money = $_GET['money'];
?>

<div style="height: 1.5rem; background: #eaeaef;"></div>
<div id="container" class="clearfix">
	<h1>支付信息</h1>
	<ul id="detail">
		<li>支付项目名称:<?php echo $project;?></li>
		<li>支付工本费</li>
	</ul>
	<ul id="pay">
		<li>支付金额:</li>
		<li><?php echo $money;?>.00元</li>
	</ul>
	<div id="p-total">共支付<?php echo $money;?>.00 元</div>
</div>
<div style="height: 2rem; background: #eaeaef;"></div>
<div id="footer">
	<button id="btn"><a href="http://localhost/hdxg/application/views/pay_succes.php">确认付款</a></button>
</div>
<script type="text/javascript" src="../assets/front/js/calculate.js"></script>
</body>
</html>