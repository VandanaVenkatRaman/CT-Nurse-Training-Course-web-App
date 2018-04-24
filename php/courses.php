<?php

include ('dbh.php');
session_start();
$emailId = $_SESSION["email"];
class courseAndInstructionDisplay{

    public $isQuiz = false;
    public $isCompleted = false;
    public $courseName;
}
function getCourseMaterial ($emailId, $dbConn)
{
    $query_courseTable = "SELECT `courseID` , `courseName` FROM `course_section`";
    $result_courseTable = mysqli_query($dbConn, $query_courseTable);
    $courseInstructionDisplay = array();

    while ($row = mysqli_fetch_array($result_courseTable)) {
        $courseId = $row[0];
        $courseName = $row[1];
        $courseAndInstructionDisplayObj = new courseAndInstructionDisplay();
        $courseAndInstructionDisplayObj->courseName = $courseName;

        $query_TestQuestionTable = "SELECT DISTINCT `courseID` from `test_question` WHERE `courseID`= $courseId  ";
        $result_TestQuestionTable = mysqli_query($dbConn, $query_TestQuestionTable);
        if ($row1 = mysqli_fetch_assoc($result_TestQuestionTable)) {
            $courseAndInstructionDisplayObj->isQuiz = true;
        }

        $query_ResultTable = "SELECT `courseID` FROM `user_test_result` WHERE `grade` >= 80 and `email` = '$emailId' and `courseID`= $courseId ";
        $result_ResultTable = mysqli_query($dbConn, $query_ResultTable);
        if ($row2 = mysqli_fetch_assoc($result_ResultTable)) {
            $courseAndInstructionDisplayObj->isCompleted = true;
        }

        $query_ResultTable = "SELECT `courseID` FROM `user_test_result` WHERE `attempt` > 2 and `email` = '$emailId' and `courseID`= $courseId ";
        $result_ResultTable = mysqli_query($dbConn, $query_ResultTable);
        if ($row2 = mysqli_fetch_assoc($result_ResultTable)) {
            $courseAndInstructionDisplayObj->isCompleted = true;
        }


        $courseInstructionDisplay[$courseId] = $courseAndInstructionDisplayObj;
    }
    return $courseInstructionDisplay;
}
?>