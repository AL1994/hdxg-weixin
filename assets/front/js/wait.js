(function(){
	window.setInterval(function run(){
	var aWait = document.getElementById("wait");
	if(aWait.innerHTML == 0){
		return false;
	}
	aWait.innerHTML = aWait.innerHTML - 1;
}, 1000);
})();