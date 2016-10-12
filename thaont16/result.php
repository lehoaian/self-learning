<html>
<head><title>Addition php</title></head>
<body>

<?php
// define variables and set to empty values
$user_name = $password = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $user_name = $_POST['user_name'];
	$user_password = $_POST['password'];
	
	$hash_md5 = md5($user_password);

	// Create connection
	$conn = mysqli_connect('localhost', '', '', 'test') or die ('Eror');
	mysqli_set_charset($conn, "utf8");
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	// prepare and bind
	$stmt = $conn->prepare("SELECT * FROM tb_user WHERE username=? AND password=?");
	$stmt->bind_param("ss", $user_name, $hash_md5);

	// set parameters and execute
	$stmt->execute();
	
	$i=0;
	while ($stmt->fetch()){
		//$stmt->bind_result($row[$i]);
		$i++;
	}
	
	if ($i == 0){
		echo "Login failed!";
	} else {
		echo "Login success with username: " . $user_name."<br>";
	}
	
	$stmt->close();
	
	//SQL : select login information form DB.
	// $sql = "SELECT * FROM tb_user WHERE username = '$user_name' AND password = '$hash_md5'";
  
	// $result = mysqli_query($conn, $sql);
	
	// if ($result->num_rows > 0) {
		// // output data
		// while($row = $result->fetch_assoc()) {
			// echo "Login success with username: " . $row["username"]."<br>";
		// }
	// } else {
		// echo "Login failed!";
	// }
	
	$conn->close();
	
	echo "<br><br>";
	
	echo "<a href ='login.php'>Go Back</a>";
    
}
else 
{
	header('Location: '."login.php");
	//Redirect('login.php', false);
}
?>
</body>
</html>