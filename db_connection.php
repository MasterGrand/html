<?php
function OpenCon()
{
    $host = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "password";
    $db = "temp";
    
    //$pdo = new PDO('mysql:host=localhost;dbname='.$db, $dbuser, $dbpass);
    $conn = mysqli_connect($host, $dbuser, $dbpass, $db);
    
    return $conn;
}

function CloseCon($conn) {
    $conn -> close();
}   
?>