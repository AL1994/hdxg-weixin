<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<base href="<?php echo site_url();?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href = "assets/front/css/news_center.css">
	<title>新闻中心</title>
</head>
<body>
<div id="wrapper">
	<div id="scroller">
		<ul id="thelist">
			<li>
				<a href="welcome/news_detail">
					<h1>一个特别重要的新闻标题</h1>
					<h2>2015/02/12&nbsp;&nbsp;12:30</h2>
					<p>
						新闻的内容很是枯燥，我实在是谢步稀缺了，大家自己看吧。很对新闻的内容很是枯燥，我实在是谢步稀缺了，是谢步大家自己看吧...
					</p>
				</a>
			</li>
			<li>
				<a href="welcome/news_detail">
					<h1>一个特别重要的新闻标题</h1>
					<h2>2015/02/12&nbsp;&nbsp;12:30</h2>
					<p>
						新闻的内容很是枯燥，我实在是谢步稀缺了，大家自己看吧。很对新闻的内容很是枯燥，我实在是谢步稀缺了，是谢步大家自己看吧...
					</p>
				</a>
			</li>
			<li>
				<a href="welcome/news_detail">
					<h1>一个特别重要的新闻标题</h1>
					<h2>2015/02/12&nbsp;&nbsp;12:30</h2>
					<p>
						新闻的内容很是枯燥，我实在是谢步稀缺了，大家自己看吧。很对新闻的内容很是枯燥，我实在是谢步稀缺了，是谢步大家自己看吧...
					</p>
				</a>
			</li>
			<li>
				<a href="welcome/news_detail">
					<h1>一个特别重要的新闻标题</h1>
					<h2>2015/02/12&nbsp;&nbsp;12:30</h2>
					<p>
						新闻的内容很是枯燥，我实在是谢步稀缺了，大家自己看吧。很对新闻的内容很是枯燥，我实在是谢步稀缺了，是谢步大家自己看吧...
					</p>
				</a>
			</li>
			<li>
				<a href="welcome/news_detail">
					<h1>一个特别重要的新闻标题</h1>
					<h2>2015/02/12&nbsp;&nbsp;12:30</h2>
					<p>
						新闻的内容很是枯燥，我实在是谢步稀缺了，大家自己看吧。很对新闻的内容很是枯燥，我实在是谢步稀缺了，是谢步大家自己看吧...
					</p>
				</a>
			</li>
		</ul>
		<div id="pullUp">
			<span class="pullUpIcon"></span>
			<span class="pullUpLabel">加载更多</span>
		</div>
	</div>
</div>
<script type="text/javascript" src="assets/front/js/iscroll.js"></script>
<script type="text/javascript" src="assets/front/js/calculate.js"></script>
<script type="text/javascript">
	var myScroll,
		pullUpEl, pullUpOffset,
		generatedCount = 0;

	function pullUpAction () {
		setTimeout(function () {
			var el, li, i;
			el = document.getElementById('thelist');

			for (i=0; i<3; i++) {
				li = document.createElement('li');
				li.innerText = 'Generated row ' + (++generatedCount);
				el.appendChild(li, el.childNodes[0]);
			}

			myScroll.refresh();
		}, 1000);
	}

	function loaded() {
		pullUpEl = document.getElementById('pullUp');
		pullUpOffset = pullUpEl.offsetHeight;

		myScroll = new iScroll('wrapper', {
			useTransition: true,
			vScrollbar: false,
			onRefresh: function () {
				if (pullUpEl.className.match('loading')) {
					pullUpEl.className = '';
					pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载更多';
				}
			},
			onScrollMove: function () {
				if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
					pullUpEl.className = 'flip';
					pullUpEl.querySelector('.pullUpLabel').innerHTML = '松手刷新';
					this.maxScrollY = this.maxScrollY;
				} else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
					pullUpEl.className = '';
					pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载更多';
					this.maxScrollY = pullUpOffset;
				}
			},
			onScrollEnd: function () {
				if (pullUpEl.className.match('flip')) {
					pullUpEl.className = 'loading';
					pullUpEl.querySelector('.pullUpLabel').innerHTML = 'Loading...';
					pullUpAction();	// Execute custom function (ajax call?)
				}
			}
		});

		setTimeout(function () { document.getElementById('wrapper').style.left = '0'; }, 800);
	}

	document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

	document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);
</script>
</body>
</html>