<?php
include("dbh.php");
session_start();
class course{
    public $courseName;
    public $courseDocument;
}

$email = $_SESSION['email'];
if($_POST['action'] == "getCourseMaterial") {
    $courseId = $_POST['courseId'];

    $query_getCourseMaterial = "SELECT `courseDocument`, `courseName` FROM `course_section` WHERE `courseID` =$courseId";
    $result = mysqli_query($dbconn, $query_getCourseMaterial);
    $courseMaterial = mysqli_fetch_array($result);
    $courseObj = new course();
    $courseObj->courseName = $courseMaterial[1];
    $courseObj->courseDocument = $courseMaterial[0];
}
$courseInstruction = array($courseId=>$courseObj);

header("Content-type:application/json");
echo json_encode($courseInstruction);

?>