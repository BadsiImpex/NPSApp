<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: http://localhost:8080/admin/dashboard.php");
    exit;
}
 
// Include config file
require_once "configtodb.php";
	$host=$config['DB_HOST'];
    $dbname=$config['DB_DATABASE'];
	$pdo= new PDO("mysql:host=$host;dbname=$dbname",$config['DB_USERNAME'],$config['DB_PASSWORD']);
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 echo "request received<br>";
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
		echo $username_err;
    } else{
        $username = trim($_POST["username"]);
		echo $username;
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
		echo '<br> '.$password;
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT ninja_password FROM admin_ninja_peeps WHERE ninja_name = :username";
        echo '<br> verification started';
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            echo '<br> pdo prepared:'.$sql;
            // Set parameters
            $param_username = trim($_POST["username"]);
			echo '<br>'.$param_username;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
				echo '<br>executed3';
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $hashed_password = $row["ninja_password"];
                        $password = md5($password);
                        echo '<br>Hashed Password: '.$hashed_password;
                        echo '<br>'.$password;
                        if($password === $hashed_password){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = '1';
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: http://localhost:8080/admin/NPSadmin.php");
	                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
							echo $password_err;
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 