function updatePage(x){
	var arr = [['dashboard','./dashboard.html'],['responses','./responses.html']];
	var pageHttp = new XMLHttpRequest();
	console.log("request made ok");
	pageHttp.onreadystatechange = function() {
		console.log(this.status + " " + this.readyState);
		if (this.readyState == 4 && this.status == 200) {
			console.log("request made");
	    document.getElementById("updateDiv").innerHTML =
	    this.responseText;
		if (x == 0){
			loadNPSScore();
		} else if (x == 1) {
			loadResponses();
		} else {
			//  block of code to be executed if the condition1 is false and condition2 is false
		}

	  }
	 };
	pageHttp.open("POST", arr[x][1], true);
    pageHttp.send();	
}
