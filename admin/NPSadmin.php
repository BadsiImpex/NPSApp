<?php
session_start();
if(isset($_SESSION['loggedin'])){

?>
<!--start HTML-->
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>index</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="frontend/css/style.css" type="text/css">
        
    </head>
    
    <body onload="updatePage(0)">
		<div id="pageContent">
			    <div class="oneCol darkBackground" style="height: 100vh">    
        <div class="centerDiv">   
            <img src="frontend/images/logo.svg" alt="logo" width="71px" style="margin: 70px auto;">
            <div class="squareNav centerDiv" onclick="updatePage(0)">
                <img src="frontend/images/performance.svg" >
                    <p>Performance</p>
            </div>
            <div class="squareNav centerDiv" onclick="updatePage(1)">
                <img src="frontend/images/responses.svg">
                    <p>Responses</p>
            </div>
            <div class="squareNav centerDiv">
                <img src="frontend/images/account.svg">
                    <p>Account</p>
                          <p style="margin-top: -8px; color: #FF7062">MANAGER</p>
            </div>
            <div class="squareNav centerDiv">
                <img src="frontend/images/log_out.svg">
                    <p>Log-out</p>
            </div>
        </div>
    </div>
			<div id="updateDiv"></div>
		</div>
		<script type="text/javascript" src="frontend/js/pageUpdate.js"></script>
		<script type="application/javascript" src="frontend/js/graph.js"></script>
        <script type="text/javascript" src="frontend/js/main.js"></script>
		
</body>
</html>

<?php } else {
echo 'Please Login2';
}
?>
