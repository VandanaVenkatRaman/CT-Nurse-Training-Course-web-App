<?php

class answer {
    public $answerId;
    public $answerText;
}
include("dbh.php");
session_start();
$email = $_SESSION['email'];
$questionsAndAns;
if($_POST['action'] == "getQuizQuestionsAnswers") {
    $courseId = $_POST['courseId'];

    $query_question = "SELECT Q.questionName, A.answerName , A.answerID FROM `test_question` Q , `test_answer` A WHERE Q.questionID = A.questionID AND Q.courseID =$courseId";
    $result = mysqli_query($dbconn,$query_question);
    $questionsAndAns = array();

    while($row1 = mysqli_fetch_array($result)){
        $question = $row1[0];
        $answerObj = new answer();
        $answerObj->answerId = $row1[2];
        $answerObj->answerText = $row1[1];
        if(!isset($questionsAndAns[$question])){
            $questionsAndAns[$question] = array();
        }
        array_push($questionsAndAns[$question], $answerObj);
    }
    header("Content-type:application/json");
    echo json_encode($questionsAndAns);
}
else if($_POST['action'] == "submitQuizAnswers") {
    $totalCorrectAns = 0;
    $totalWrongAns =0;

    $userAns = $_POST[ansCollection];
    foreach ($userAns as $selectedOption){
        $query_answer ="SELECT answerID,isAnswer,questionID FROM `test_answer` where answerID =$selectedOption";
        $result = mysqli_query($dbconn,$query_answer);
        $row = mysqli_fetch_array($result);
        $answerId =$row[0];
        $isAnswer = strtoupper($row[1]);
        $questionId = $row[2];

        if((strcmp($isAnswer,"Y") == 0)){
            $totalCorrectAns++;
        }
        else{
            $totalWrongAns++;
        }
        $insertUserTestQuery = "INSERT INTO `user_test` (`createdBy`,`createdOn`,`questionID`,`answerID`,`isCorrect`,`email`) VALUES('System',now(),$questionId,$answerId,'$isAnswer','$email')";
        $result1 = mysqli_query($dbconn,$insertUserTestQuery);
//        if (!$result1) {
//            echo("Error description: " . mysqli_error($dbconn));
//        }
        $score = array("CorrectAns"=>"$totalCorrectAns", "WrongAns"=>"$totalWrongAns");

    }

    header("Content-type:application/json");
    echo json_encode($score);
}
?>