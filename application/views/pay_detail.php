<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="<?php echo site_url();?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/front/css/pay_detail.css">
	<title>确认支付</title>
</head>
<body>
<div class="wrap">
<!--	<h3 class="til1"><span></span>&nbsp;学生学号</h3>-->
<!--	<div class="msg1"></div>-->
	<h3 class="til1"><span>*</span>&nbsp;学生学号:</h3>
	<div class="msg1"><?php echo $project->student_id;?></div>
	<h3 class="til2"><span>*</span>&nbsp;学生姓名:</h3>
	<div class="msg2"><?php echo $project->name;?></div>
	<h3 class="til3"><span>*</span>&nbsp;专业:</h3>
	<div class="msg3"><?php echo $project->major;?></div>
	<h3 class="til4"><span>*</span>&nbsp;申请时间:</h3>
	<div class="msg4"><?php echo date('y-m-d h:i:s',time());?></div>
	<h3 class="til5"><span>*</span>&nbsp;支付内容:</h3>
	<div class="msg5"><?php echo $project->category;?></div>
	<h3 class="til6"><span>*</span>&nbsp;支付金额:</h3>
	<div class="msg6"><?php echo $project->money;?></div>
	<button><a href="wxpay/pay_confirm.php?pro=<?php echo $project->category;?>&money=<?php echo $project->money;?>">确认付款</a></button>
</div>
<script type="text/javascript" src="assets/front/js/calculate.js"></script>
</body>
</html>