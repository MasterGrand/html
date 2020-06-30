<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text\css" href="temp.css">
<body>
<?php
$allowSignups = TRUE;
if (!$allowSignups) {
	header('Location:/');
	die();
}

include 'db_connection.php';
if(isset($_POST["submit"])) {
	$user = strtolower($_POST["fname"]);
	$pass = $_POST["age"];
	$pass = md5($pass);
}

$dbconnect = OpenCon();

$query = mysqli_query($dbconnect, "SELECT * FROM users") or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
	if ($row['username'] == $user) {
		die ("User already created, please choose a different username.");
	}
}

$ip = $_SERVER['REMOTE_ADDR'];
$sql = "INSERT INTO users(username,password,ip) VALUES ('$user','$pass','$ip')";

if ($dbconnect->query($sql) === TRUE) {
  echo "New record created successfully.<br>Redirecting to login in 4 seconds.";
  header('Refresh: 4; URL=/');
} else {
  echo "Error: " . $sql . "<br>" . $dbconnect->error;
}

CloseCon($dbconnect);
?>

</body>
</html>
