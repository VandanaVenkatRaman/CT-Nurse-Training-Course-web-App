<?php

class report {
    public $email;
    public $courseid;
	public $startdate;
	public $enddate;
	public $grade;
	public $firstname;
	public $lastname;
}

include("dbh.php");
session_start();
$email = $_SESSION['email'];
$reportArray;
if($_POST['action'] == "getTestReports") {
    $query_report = "SELECT * FROM `user_test_result` ORDER BY `email`";
	$report_result = mysqli_query($dbconn,$query_report);
    $reportArray = array();

    while($row1 = mysqli_fetch_array($report_result)){

        $resultid = $row1[0];
        $reportObj = new report();
        $reportObj->email = $row1[1];
        $reportObj->courseid = $row1[2];
		$reportObj->startdate = $row1[3];
		$reportObj->enddate = $row1[4];
		$reportObj->grade = $row1[5];

		$query_user = "SELECT firstName,lastName FROM `user` WHERE email= '$reportObj->email'" ;
		$user_result = mysqli_query($dbconn,$query_user);

		$row2 = mysqli_fetch_array($user_result);
		$reportObj->firstname = $row2[0];
		$reportObj->lastname = $row2[1];

		$reportArray[$resultid] = array();
        array_push($reportArray[$resultid], $reportObj);
    }

    header("Content-type:application/json");
    echo json_encode($reportArray);
}

?>
