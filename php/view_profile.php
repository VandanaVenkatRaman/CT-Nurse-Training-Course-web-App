<?php
    class user {
    public $firstName;
    public $lastName;
    public $universityName;
    public $graduationYear;
    public $email;
    }
include("dbh.php");
session_start();

if($_POST['action'] == "getUserDetails") {
    $emailId = $_SESSION["email"];
    $query_schoolId = "SELECT schoolId FROM `user` WHERE email = '$emailId'";
    $result = mysqli_query($dbconn,$query_schoolId);
    $schoolId =mysqli_fetch_array($result);
    if($schoolId[0]==46){
        $query_user = "SELECT firstName ,lastName, otherUniversity, graduationYear FROM `user` WHERE email ='$emailId'";
        $userDetail = mysqli_query($dbconn,$query_user);
        $row = mysqli_fetch_array($userDetail);
        if (!$row) {
           echo("Error description: " . mysqli_error($dbconn));
        }
    }
    else{
        $query_user = "SELECT U.firstName ,U.lastName, S.schoolName ,U.graduationYear FROM `user` U, `school` S WHERE U.email ='$emailId' AND U.schoolId = S.schoolId and S.schoolId =$schoolId[0]";
        $userDetail = mysqli_query($dbconn,$query_user);
        $row = mysqli_fetch_array($userDetail);
        if (!$row) {
            echo("Error description: " . mysqli_error($dbconn));
        }
    }

    $userObj = new user();
    $userObj->email = $emailId;
    $userObj->firstName = $row[0];
    $userObj->lastName =$row[1];
    $userObj->universityName =$row[2];
    $userObj->graduationYear =$row[3];

}
header("Content-type:application/json");
echo json_encode($userObj);
?>
