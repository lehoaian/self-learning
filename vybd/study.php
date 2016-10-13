<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<?php
$name = $password = "";
$servername = "localhost";
$username = "root";
$password = "vertrigo";
$dbName= "study_tec";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["username"])||empty($_POST["password"])){
		echo "Please enter username & password";
	}else{
		$conn = new mysqli($servername, $username, $password, $dbName);
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		} 
		$sql="SELECT username from users where username='".$_POST["username"]."' and password ='".md5($_POST["password"])."'";
		$result = $conn->query($sql);
		if($result->num_rows == 1){
			echo "Logedin";
			?>
			<style type="text/css">#loginForm{
				display:none;
			}</style>
			<?php
		}else{
			Echo "Wrong username and password";
		}
		$conn->close();
	}
}
?>
<form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
Username: <input type="text" name="username" value="<?php echo $name;?>">
<p>
Password: <input type="password" name="password" value="<?php echo $password;?>">
<p>
<input type="submit" name="submit" value="Submit"> 
</form>
</body>
</html>
