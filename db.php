<!DOCTYPE html>
<head>

<table border="1" align="center">
<tr>
  <td><b>username</b></td>
  <td><b>password</b></td>
</tr>

<?php
include 'db_connection.php';
$dbconnect = OpenCon();
$query = mysqli_query($dbconnect, "SELECT * FROM users")
   or die (mysqli_error($dbconnect));


while ($row = mysqli_fetch_array($query)) {
  echo "<tr><td>{$row['username']}</td><td>{$row['password']}</td></tr>";
}
?>
</table>

</head>