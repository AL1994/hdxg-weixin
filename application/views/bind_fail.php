<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<base href="<?php echo site_url();?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/front/css/bind_fail.css">
	<title>bind-fail</title>
</head>
<body>
	<div class="main">
		<p class="fail">绑定未成功<br/>请核对学生学号</p>
		<img class="cat" src="assets/front/img/cat-1.png">
		<p class="wait"><span id="wait">3</span>&nbsp;秒后页面自动跳转</p>
		<button class="back"><a href="welcome/">返&nbsp;&nbsp;&nbsp;&nbsp;回</a></button>
	</div>
	<script src="assets/front/js/wait.js"></script>
	<script type="text/javascript" src="assets/front/js/calculate.js"></script>
	<script>
		var aWait = document.getElementById("wait");
		setTimeout(function(){
			if(aWait.innerHTML == 0){
				location.href = 'welcome/';
			}
		},3500)
	</script>
</body>
</html>

	