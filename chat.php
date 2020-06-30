<?php
session_start();
if ($_SESSION['username'] == "") {
    header('Location:/');
    die("Unauthorized");
}
?>

<!DOCTYPE html>
<head>

<?php
include 'db_connection.php';
$dbconnect = OpenCon();
echo $_SESSION['username'] . ": ";
?>

<form action="chat.php" method="post">
    <input type="text" name="message">
    <input type="submit" name="insert" value="Send">
    <input type="submit" name="logout" value="logout">
</form>

<?php
$query = mysqli_query($dbconnect, "SELECT * FROM messages") or die (mysqli_error($dbconnect));


while ($row = mysqli_fetch_array($query)) {
    echo "{$row['date']} <b>| {$row['user']}:</b> {$row['message']}<br>";
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['insert']) and $_POST['message'] != "") {
    $user = $_SESSION['username'];
    $message = $_POST['message'];
    $date = date("Y-m-d H:i:s");
    $query = "INSERT INTO messages(user,date,message) values ('$user','$date','$message')";
    mysqli_query($dbconnect, $query);
    header('Location:/chat.php');
    //header('Refresh: 0.5; URL=/chat.php');
}
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout'])) {
    session_destroy();
    header('Location:/');
}

header('Refresh: 20; URL=/chat.php');
?>

</head>