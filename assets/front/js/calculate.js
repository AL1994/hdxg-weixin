/**Created by Administrator on 2016/4/27.*/
(function(){
    var _winWidth=document.body.clientWidth || document.documentElement.clientWidth,_style=document.getElementsByTagName("html")[0].style;
    _winWidth >= 640 ? _style.fontSize = "20px" : _style.fontSize = _winWidth/32 + "px";
})();