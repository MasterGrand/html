<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php
    include 'db_connection.php';
	$_SESSION['username'] = $_POST["fname"] or die("Please log in again.");
	$_SESSION['password'] = md5($_POST["age"]) or die("Please log in again.");
    
    // Create connection
    $dbconnect = OpenCon();

    $temp = $_SESSION['username'];
    $query = mysqli_query($dbconnect, "SELECT * FROM users where username = '$temp'") or die ("Invalid username.");
    $dat = mysqli_fetch_array($query);
    if ($dat['password'] == "") {
        session_destroy();
        die("Invalid username.");
    } elseif ($dat['password'] == $_SESSION['password']) {
        echo '<p>Welcome back, ' . $_SESSION['username'] . '!</p>';
    } else {
        session_destroy();
        die('<p>Invalid password.</p>');
    }
    header('Refresh: 4; URL=/chat.php');
?>