<?php
session_start();
if(isset($_SESSION['loggedin'])){

?>
<!--start HTML-->
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>NPS Admin Dashboard</title>
  </head>
  <body>
  <?php     echo 'Hello '.$_SESSION['username']; ?>
  <div id="scoreDiv"></div>
  <button onclick="loadNPSScore();">Get Score</button>
  </body>
<script>
    let npsScore;
    function loadNPSScore() {
        console.log('function called');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            console.log(this.status);
            console.log("\nStatus Text: "+this.statusText);
            if (this.readyState == 4 && this.status == 200) {
                 npsScore = JSON.parse(this.responseText);
                document.getElementById('scoreDiv').innerHTML= "Score is "+npsScore.score;
                 console.log('this is npsScore: '+npsScore);
            }
        };
        xhttp.open("POST", "/admin/php/nps.php", true);
        xhttp.send();
    }
</script>
</html>

<?php } else {
echo 'Please Login2';
}
?>
