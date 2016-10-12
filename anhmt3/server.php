<!DOCTYPE html>
<html>
	<body>
	<?php
	if (empty($_POST)){
		header("Location: login.php");
		die();
	}
	
	$username= $_POST["username"];
	$password= $_POST["password"];
	
	connectDB($username, md5($password));
	
	function connectDB($username, $pwdmd5){
		$servername = "localhost";
		$usernameDB = "";
		$passwordDB = "";
		$dbname = "test";

		// Create connection
		$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT user, passwd FROM account WHERE user= '$username' AND passwd= '$pwdmd5'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo $row["user"]. " login success.";
				break;
			}
		} else {
			echo "Login unsuccess.";
		}
		$conn->close();
	}
	?>
	</body>
</html>
