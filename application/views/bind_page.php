<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="<?php echo site_url();?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>黑龙江大学学工部</title>
	<link rel="stylesheet" href="assets/front/css/bind_page.css">
</head>
<body>
	<div id="title">
		<img src="assets/front/img/hd_logo.png" alt="">
		<p class="title1">黑龙江大学学工部</p>
		<hr>
		<p class="title2">Heilongjiang University Division Of Student-wise Affairs</p>
		<input type="text" class="name" name="name" placeholder="请输入学号...">
		<input type="text" class="password" name="password" placeholder="请输入密码...">
		<button id="btn">账号绑定</button>
	</div>
	<script type="text/javascript" src="assets/front/js/calculate.js"></script>
	<script type="text/javascript" src="assets/front/js/zepto.js"></script>
	<script>
		$(function(){
			//welcome/bind_succes
			$('.name').blur(function(){
				$.post('welcome/check_bind',{username:$('.name').val()},function(res){
					if(res == 'success'){
						alert("您已绑定，不能重复绑定！");
						location.href = location.href;
					}
				});
			});
			$('#btn').tap(function(){
				if($('.name').val() && $('.password').val()){
					$.post('welcome/check_user',{username:$('.name').val()},function(res){
						if(res == 'success'){
							location.href = "welcome/bind_succes";
						}else{
							location.href = "welcome/bind_fail";
						}
					});
				}else{
					alert('所填信息不完整！');
				}
			})

		});
	</script>
</body>
</html>