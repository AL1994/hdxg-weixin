<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="<?php echo site_url();?>">
	<title>支付列表</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="assets/front/css/pay_list.css">
</head>
<body>
	<?php if($card){?>
		<div class="container">
			<div class="bg"></div>
			<div class="content clearfix">
				<img src="assets/front/img/pto.png" alt="">
				<div class="ct">
					<div>学生证工本费</div>
					<div>25.00元</div>
					<button><a href="welcome/pay_detail?student_id=<?php echo $card->student_id;?>&card=<?php echo$card->category;?>">去支付</a></button>
				</div>
			</div>
		</div>
	<?php }?>
	<?php if($pto){?>
		<div class="container">
			<div class="bg"></div>
			<div class="content clearfix">
				<img src="assets/front/img/pto.png" alt="">
				<div class="ct">
					<div>照片采集工本费</div>
					<div>20.00元</div>
					<button><a href="welcome/pay_detail?student_id=<?php echo $pto->student_id;?>&card=<?php echo $pto->category;?>">去支付</a></button>
				</div>
			</div>
		</div>
	<?php }?>
	<div class="container">
		<div class="bg"></div>
	</div>
	<script type="text/javascript" src="assets/front/js/calculate.js"></script>
</body>
</html>