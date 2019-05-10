var FD = new FormData();
function getURLParams(){
		var url = window.location.search.slice(1);
		console.log(url);
		var queryString = url.split("&");
		for(var i = 0; i<queryString.length; i++){
			var a = queryString[i].split("=");
			FD.append(a[0],a[1]);
			console.log(FD.get(a[0]));
		}
	};	

function createFormData(refId,scrCurrent,scrNext){
	var mainData = document.getElementById(refId).value;
	FD.append(refId, mainData);
	console.log(FD.get(refId));
	document.getElementById(scrCurrent).style.display = "none";
	document.getElementById(scrNext).removeAttribute("style"); 
	};
	
function sendData(refId,scrCurrent,scrNext) {
	createFormData(refId,scrCurrent,scrNext);
	
	if (window.XMLHttpRequest) {
			var XHR = new XMLHttpRequest();
			XHR.addEventListener('load', function(event){
				//alert('Data submitted to php and response was: ' + XHR.response );
				});
			XHR.addEventListener('error',function(event){
				//alert('error occured');
				});
			XHR.open('POST','./php/ratetransfer.php');
			XHR.send(FD);
	} else {
		// code for old IE browsers

	}
};
	


