<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="<?php echo site_url();?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>绑定成功</title>
    <link rel="stylesheet" href="assets/front/css/bind_succes.css">
</head>
<body>
	<div id="container">
		<div class="circle">
			<img src="assets/front/img/yes.png" alt="">
		</div>
		<p class="success">绑定成功</p>
		<p class="jump"><span id="wait">3</span> 秒页面自动跳转...</p>
		<img class="plane" src="assets/front/img/plane.jpg" alt="">
	</div>
	<script type="text/javascript" src="assets/front/js/calculate.js"></script>
	<script src="assets/front/js/wait.js"></script>
	<script>
		var aWait = document.getElementById("wait");
		setTimeout(function(){
			if(aWait.innerHTML == 0){
				location.href = 'welcome/pay_list';
			}
		},3500)
	</script>
</body>
</html>