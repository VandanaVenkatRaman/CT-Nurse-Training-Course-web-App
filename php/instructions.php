<?php
include("dbh.php");
session_start();
$email = $_SESSION['email'];

$courseId;
if($_POST['action'] == "getCourseMaterial") {
    $courseId = $_POST['courseId'];

        $query_getCourseMaterial = "SELECT `courseDocument` FROM `course_section` WHERE `courseID` =$courseId";
    $result = mysqli_query($dbconn, $query_getCourseMaterial);
    $courseMaterial = mysqli_fetch_array($result);
}
$courseInstruction = array($courseId=>$courseMaterial[0]);

header("Content-type:application/json");
echo json_encode($courseInstruction);

?>