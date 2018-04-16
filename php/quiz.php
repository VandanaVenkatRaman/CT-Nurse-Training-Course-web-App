<?php

class answer {
    public $answerId;
    public $answerText;
}
function shuffle_assoc(&$array) {
    $keys = array_keys($array);
    shuffle($keys);
    foreach($keys as $key) {
        $new[$key] = $array[$key];
    }
    $array = $new;
    return true;
}
include("dbh.php");
session_start();
$email = $_SESSION['email'];
$questionsAndAns;
$courseId;
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
        shuffle($questionsAndAns[$question]);
    }

    shuffle_assoc($questionsAndAns);
    header("Content-type:application/json");
    echo json_encode($questionsAndAns);
}
else if($_POST['action'] == "submitQuizAnswers") {
    $totalCorrectAns = 0;
    $totalWrongAns =0;
    $totalQuestion =0;
    $courseId = $_POST['courseId'];
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
        $totalQuestion++;
        $insertUserTestQuery = "INSERT INTO `user_test` (`createdBy`,`createdOn`,`questionID`,`answerID`,`isCorrect`,`email`) VALUES('System',now(),$questionId,$answerId,'$isAnswer','$email')";
        $result1 = mysqli_query($dbconn,$insertUserTestQuery);
//        if (!$result1) {
//            echo("Error description: " . mysqli_error($dbconn));
//        }
        $score = array("CorrectAns"=>"$totalCorrectAns", "WrongAns"=>"$totalWrongAns");

    }
    $grade = ($totalCorrectAns/$totalQuestion) * 100;
    $selectUser = "SELECT * FROM `user_test_result` where email ='$email'";
    $selectResult  = mysqli_query($dbconn,$selectUser);
    if(!$row = mysqli_fetch_assoc($selectResult)){
        $insertUserResultQuery ="INSERT INTO `user_test_result`(`email`, `courseID`, `startDate`, `endDate`, `grade`,`attempt`) VALUES ('$email',$courseId,now(),now(),$grade,1)";
        $insertResult = mysqli_query($dbconn,$insertUserResultQuery);
    }
    else{

        $selectUserResultQuery = "SELECT `attempt` FROM `user_test_result` WHERE `email`='$email' ";
        $selectResult = mysqli_query($dbconn,$selectUserResultQuery);

        $row = mysqli_fetch_array($selectResult);
        $attempt = $row[0];


        if($attempt <3){
            ++$attempt;
            $updateUserResultQuery ="UPDATE `user_test_result` SET `grade` =$grade , `attempt` = $attempt WHERE `email`='$email' ";
            $updateResult = mysqli_query($dbconn,$updateUserResultQuery);
        }
    }
    header("Content-type:application/json");
    echo json_encode($score);
}
?>
