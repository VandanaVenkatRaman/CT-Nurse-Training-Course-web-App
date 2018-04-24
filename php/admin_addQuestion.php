<?php
include("dbh.php");
require("admin_page-template.php");
session_start();
$dashboard = new Page();
$emailId = $_SESSION['email'];
$msg = '';
$options = '';
$courseNameQuery = "SELECT * from `course_section`";
$courseNames = mysqli_query($dbconn,$courseNameQuery);

$correctOptA ='N';
$correctOptB ='N';
$correctOptC ='N';
$correctOptD ='N';

if (isset($_POST['AddQuestion'])){
    $courseId = $_POST['courseName'];
    $difficulty = $_POST['questionDifficulty'];
    $question = $_POST['Question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correctAns = $_POST['correctAns'];

    if($correctAns == '1'){
        $correctOptA ='Y';
    }else if($correctAns == '2'){
        $correctOptB ='Y';
    }else if($correctAns == '3'){
        $correctOptC ='Y';
    }else {
        $correctOptD ='Y';
    }

    $InsertQuestionQuery = "INSERT INTO `test_question`(`questionName`,`questionDifficulty`,`isActive`,`createdBy` ,`createdOn` ,`updatedBy`,`updatedOn`,`courseID`)
                            VALUES ('$question' , '$difficulty' ,'Y','$emailId',now(),'$emailId',now(),$courseId)";
    if ($insertQuestionResult = mysqli_query($dbconn,$InsertQuestionQuery)){
        $last_id = mysqli_insert_id($dbconn);
       // echo $last_id;
    }
    $insertAnsQuery ="INSERT INTO `test_answer`(`answerName`,`isAnswer`,`isActive`,`createdBy` ,`createdOn` ,`updatedBy`,`updatedOn`,`questionID`)
                      VALUES
                      ('$option1' , '$correctOptA' ,'Y','$emailId',now(),'$emailId',now(),'$last_id'),
                      ('$option2' , '$correctOptB' ,'Y','$emailId',now(),'$emailId',now(),'$last_id'),
                      ('$option3' , '$correctOptC' ,'Y','$emailId',now(),'$emailId',now(),'$last_id'),
                      ('$option4' , '$correctOptD' ,'Y','$emailId',now(),'$emailId',now(),'$last_id')
    ";
    $insertAnsResult = mysqli_query($dbconn,$insertAnsQuery);

    if(!$insertQuestionResult || !$insertAnsResult) {
        $msg = 'Failed to add question to the course ';
        $messageClass = "alert alert-danger";
       // echo("Error description: " . mysqli_error($dbconn));
    }
    else{
        $msg = ' Question added Successfully to the course ';
        $messageClass = "alert alert-success";
    }
}
$options = "<option value =\"\">SELECT</option>";
while($row1 = mysqli_fetch_array($courseNames)){
    $options = $options. "<option value =\"$row1[0]\">".$row1[1]."</option>";
}
$dashboard->content = "

<h2> Add Question </h2>

<div id='admin' class='dynamic-container'>
<form class=\"form-horizontal\" method=\"POST\">

  <h4 class=\"$messageClass\">$msg</h4>
    <div class=\"form-group\">
      <div class=\"col-sm-12\">
        <label for=\"coursename\" class=\"control-label\">Select Module</label>
  	    <select required name=\"courseName\"  class=\"form-control\">".$options.
    "</select>
  	  </div>
  	</div>
  	<div class=\"form-group\">
      <div class=\"col-sm-12\">
        <label for=\"QuestionDifficulty\" class=\"control-label\">Question Difficulty</label>
  	    <select required name=\"questionDifficulty\"  class=\"form-control\">
  	        <option value =\"\">SELECT</option>
  	        <option value =\"Easy\">Easy</option>
  	        <option value =\"Moderate\">Moderate</option>
  	        <option value =\"Difficult\">Difficult</option>
        </select>
  	  </div>
 </div>
  	<div class=\"form-group\">
    <div class=\"col-sm-12\">
      <label for=\"Question\" class=\"control-label\">Question</label>
      <input type=\"text\" class=\"form-control\" name =\"Question\" id=\"question\" placeholder=\"Question\" required>
    </div>
  </div>
  <div class=\"form-group\">
    <div class=\"col-sm-12\">
      <label for=\"Option\" class=\"control-label\">Option 1</label>
      <input type=\"text\" class=\"form-control\" name =\"option1\" id=\"VideoLink\" placeholder=\"Option 1\" required>
    </div>
  </div>
  <div class=\"form-group\">
    <div class=\"col-sm-12\">
      <label for=\"Option\" class=\"control-label\">Option 2</label>
      <input type=\"text\" class=\"form-control\" name =\"option2\" id=\"VideoLink\" placeholder=\"Option 2\" required>
    </div>
  </div>
  <div class=\"form-group\">
    <div class=\"col-sm-12\">
      <label for=\"Option\" class=\"control-label\">Option 3</label>
      <input type=\"text\" class=\"form-control\" name =\"option3\" id=\"VideoLink\" placeholder=\"Option3\" required>
    </div>
  </div>
  <div class=\"form-group\">
    <div class=\"col-sm-12\">
      <label for=\"Option\" class=\"control-label\">Option 4</label>
      <input type=\"text\" class=\"form-control\" name =\"option4\" id=\"VideoLink\" placeholder=\"Option 4\" required>
    </div>
  </div>
  <div class=\"form-group\">
      <div class=\"col-sm-12\">
        <label for=\"Correct Answer\" class=\"control-label\">Correct Answer</label>
  	    <select required name=\"correctAns\"  class=\"form-control\">
  	        <option value =\"\" >SELECT</option>
  	        <option value =\"1\">Option 1</option>
  	        <option value =\"2\">Option 2</option>
  	        <option value =\"3\">Option 3</option>
  	        <option value =\"4\">Option 4</option>
        </select>
  	  </div>
 </div>
    <div class=\"form-group\">
      <div class=\"col-sm-12\">
        <button type=\"submit\" class=\"btn btn-block btn-primary\"name =\"AddQuestion\" >Add Question</button>
      </div>
    </div>
  </form>
  <p>&nbsp;</p>
</div>
    ";
$dashboard->Display();
?>
