<?php
include 'configtodb.php';
$orNumber = $rating = $message = $orMonth = $consilier = "";
if (isset($_POST['sliderRating'])){
    $orNumber = testData($_POST['orNumber']);
    $rating = testData($_POST['sliderRating']);
    $message = testData($_POST['message']);
    $orMonth = testData($_POST['month']);
    $consilier = testData($_POST['consilier']);
}

try
{
    $host=$config['DB_HOST'];
    $dbname=$config['DB_DATABASE'];
	$conn= new PDO("mysql:host=$host;dbname=$dbname",$config['DB_USERNAME'],$config['DB_PASSWORD']);
	//new PDO("mysql:host=$hostname;dbname=mysql", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO rate_birth_2019 (or_no, rating, message, or_month, Consilier)
	VALUES ('$orNumber', '$rating', '$message', '$orMonth', '$consilier')";
	$conn->exec($sql);
    //$rating = 'not working';
    //$rating = $_POST['sliderRating'];     
	//echo "There is a new record and Rating is ".$rating;
}
catch(PDOException $e)
{
    //echo "Error message:".$e->getMessage();
}
$conn = null;

//check the data for right quality
function testData($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>