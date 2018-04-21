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
function send_email($email,$percentage ,$result) {
    $to = $email;
    $subject = 'CT Nurses Training Application Test Report';
    $body= " <div>
             <h1> CT Nurses Training Application Result </h1>
             <h2>Test Score: ".$percentage."</h2>
             <h2>Test Result: ".$result."</h2>
             </div>       
    ";
    $headers = 'From : noreply@ctnursesapp.org';
   if(mail($to,$subject,$body,$headers)){
       return true;
   }
   else{
       return false;
       echo 'There was an error sending the Email';
   }
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
    $emailSent = false;
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
    }
    $grade = ($totalCorrectAns/$totalQuestion) * 100;
    $selectUser = "SELECT * FROM `user_test_result` where email ='$email' and courseID ='$courseId' ";
    $selectResult  = mysqli_query($dbconn,$selectUser);
        if(!$row = mysqli_fetch_assoc($selectResult)){
        $insertUserResultQuery ="INSERT INTO `user_test_result`(`email`, `courseID`, `startDate`, `endDate`, `grade`,`attempt`) VALUES ('$email',$courseId,now(),now(),$grade,1)";
        $insertResult = mysqli_query($dbconn,$insertUserResultQuery);
        }
        else{

        $selectUserResultQuery = "SELECT `attempt` FROM `user_test_result` WHERE `email`='$email' and courseID ='$courseId'  ";
        $selectResult = mysqli_query($dbconn,$selectUserResultQuery);

        $row = mysqli_fetch_array($selectResult);
        $attempt = $row[0];


        if($attempt <3){
            ++$attempt;
            $updateUserResultQuery ="UPDATE `user_test_result` SET `grade` =$grade , `attempt` = $attempt WHERE `email`='$email' and courseID ='$courseId'  ";
            $updateResult = mysqli_query($dbconn,$updateUserResultQuery);
        }
        }

    $courseCount =0;
    $userScoreTotal =0;

    $courseSelectQuery  = "SELECT DISTINCT `courseID` from `course_section`";
    $allCourseResult =     mysqli_query($dbconn,$courseSelectQuery);

    while($row = mysqli_fetch_assoc($allCourseResult)){
    $courseCount++;
    }
   // echo $courseCount;

    $UserResultSelectQuery  = "SELECT `courseID` FROM `user_test_result` WHERE `email` = '$email' AND (`grade`>=80 OR `attempt` >2)";
    $allUserResult =     mysqli_query($dbconn,$UserResultSelectQuery);


    while($row = mysqli_fetch_assoc($allUserResult)){
        $userScoreTotal++;
    }
    //echo $userScoreTotal;

    if($userScoreTotal == $courseCount){
        $total =0;
        $selectGrade = "SELECT `grade` FROM `user_test_result` WHERE  `email` = '$email'";
        $gradeResult = mysqli_query($dbconn,$selectGrade);

        while($row= mysqli_fetch_array($gradeResult)){
            $value = $row[0];
            $total += $value;
        }
            $percentage = ($total/$courseCount);
            if($percentage < 80 ){
                $result = 'Fail';
            }
            else{
                $result = 'Pass';
            }


     $InsertCourseCompletionQuery = "INSERT INTO user_courseCompletion_result (`email` , `endDate`, `score`, `status`)
                                     VALUES ('$email',now(),$percentage, '$result')";
        echo ($InsertCourseCompletionQuery);
        if(!mysqli_query($dbconn,$InsertCourseCompletionQuery)){
            echo("Error description: " . mysqli_error($dbconn));
        }

       $emailSent = send_email($email,$percentage ,$result);
    }
    $score = array("CorrectAns"=>"$totalCorrectAns", "WrongAns"=>"$totalWrongAns", "EmailSent" => $emailSent );
    header("Content-type:application/json");
    echo json_encode($score);
}
?>
