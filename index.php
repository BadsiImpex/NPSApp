<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="nofollow" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="frontend/css/style.css">
        <link rel="stylesheet" href="frontend/css/sliderStyle.css">
         <script type="text/javascript" src="frontend/js/main.js"></script>
    </head>
    <body onload="getURLParams()">
        <!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

		<header id="logoHeader">
            <img class="logo" src="frontend/images/logo_B.png" alt="logo_BADSI">
		</header>
		<!--This is the first screen-->
		<div id="ratingScreen" class="screenDisplaySettings">
             <div class="center topDiv">
                <img id="owl" src="frontend/images/ava.png" alt="ava">
                <p id="firstP">BINE ATI VENIT!</p>
            </div>
            <center>
                <p class="center" id="questionBox" style="justify-content: center;">
                Care este probabilitatea de a ne recomanda unui coleg sau prieten?
                </p>
            </center>
            <center id="feedCounter">1</center><p></p>
                <center>
                    <div id="orangeLine"></div>
                </center>
            <div class="slidecontainer">
                <center>
			<input name="npsRating" type="range" min="1" max="10" value="1" class="slider" id="sliderRating">
            <center onclick="createFormData('sliderRating','ratingScreen','textQuestionScreen')"><img id="arrow" src="frontend/images/arrow.png"></center>
		</div>
        </div>	
		<!--This is the Second screen-->
		<div class="screenDisplaySettings"  id="textQuestionScreen" style="display: none;">
			<div class="paddingAdj">
                <p class="secondMesage">lasati-ne un mesaj...</p>
                <center><textarea class="txtBox" name="comment" placeholder="your text here" id="message"></textarea>
                </center>
            <p id="sendButton" onclick="sendData('message','textQuestionScreen','thankYouScreen')">TRIMITE-TI!</p>
		  </div>
		</div>
		
		<!--This is the third screen-->
		<div class="screenDisplaySettings" id="thankYouScreen" style="display: none;">
			<center><img class="ava2" src="frontend/images/ava2.png"></center>
			<center><img class="thanks" src="frontend/images/thankyou.png" alt="thanks"></center>
		</div>  
        <script type="text/javascript">
            var silder = document.getElementById('sliderRating');
            silder.oninput = function (){
                document.getElementById("feedCounter").innerHTML = this.value;    
            }
            
        </script>
    </body>
</html>
