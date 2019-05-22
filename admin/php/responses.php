<?php 
//echo 'version: 2.13<br>';
include 'configtodb.php';

try {
	$host=$config['DB_HOST'];
    $dbname=$config['DB_DATABASE'];
	$conn= new PDO("mysql:host=$host;dbname=$dbname",$config['DB_USERNAME'],$config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT message,or_no,Consilier,rating FROM rate_birth_2019 WHERE 1");
	$stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$responses = $stmt->fetchAll();
	//echo "passive: ".$passive[0][0]."<br>";
	$responses_JSON = json_encode($responses);
	echo $responses_JSON;
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>