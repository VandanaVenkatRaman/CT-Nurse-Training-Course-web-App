<?php
session_start();
include 'dbh.php';

$uname = $_SESSION["email"];

$sql_username = "SELECT firstName FROM user WHERE email='$uname'";
$sql_adminName = "SELECT fname FROM `admin` WHERE adminEmail='$uname'";

$name_result = $dbconn->query($sql_username);
$adminName_result = $dbconn->query($sql_adminName);

if ($name_result->num_rows > 0) {
    // output data of each row
    while ($row = $name_result->fetch_assoc()) {
        $firstname = $row["firstName"];
    }
}
if($adminName_result->num_rows >0){
    while ($row1 = $adminName_result->fetch_assoc()) {
        $Adminname = $row1["fname"];
    }
}
?>