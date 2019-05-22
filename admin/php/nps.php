<?php 
//echo 'version: 2.13<br>';
include 'configtodb.php';

try {
	$host=$config['DB_HOST'];
    $dbname=$config['DB_DATABASE'];
	$conn= new PDO("mysql:host=$host;dbname=$dbname",$config['DB_USERNAME'],$config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$stmt = $conn->prepare("SELECT COUNT(*) FROM rate_birth_2019 WHERE rating>8"); 
    $stmt = $conn->prepare("SELECT COUNT(*) FROM rate_birth_2019 WHERE rating> :lRange AND rating < :hRange");
	$stmt->execute(array('lRange' => 6, 'hRange' => 9));
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_NUM);
	$passive = $stmt->fetchAll();
	//echo "passive: ".$passive[0][0]."<br>";
	$stmt->execute(array('lRange' => 8, 'hRange' => 11));
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_NUM);
	$promoters = $stmt->fetchAll();
	//echo "promoters: ".$promoters[0][0]."<br>";
	$stmt->execute(array('lRange' => 8, 'hRange' => 11));
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_NUM);
	$detractors = $stmt->fetchAll();
	//echo "detractors: ".$detractors[0][0]."<br>";
	$nps = npsScore($promoters[0][0], $passive[0][0], $detractors[0][0]);
	//echo "NPS is: ".$nps;
	$nps_object = new stdClass; 
	$nps_object->score = $nps; 
	$nps_object->promoters = $promoters[0][0]; 
	$nps_object->detractors = $detractors[0][0]; 
	$nps_object->passive = $passive[0][0]; 
    $nps_JSON = json_encode($nps_object);
	echo $nps_JSON;
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

function npsScore ($pCount, $nCount, $dCount) {
	$totalRes = $pCount+$nCount+$dCount;
	$perPromoter = ($pCount/$totalRes)*100;
	$perDetractor = ($dCount/$totalRes)*100;
	return $perPromoter-$perDetractor;
}
$conn = null;



//echo '<br>EOF';

?>