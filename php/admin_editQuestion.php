<?php
include("dbh.php");
require("admin_page-template.php");
session_start();
$dashboard = new Page();
$emailId = $_SESSION['email'];
$msg = '';
$questionOpts ='';
$populateValue ='';
$courseNameQuery = "SELECT * from `course_section`";
$courseNames = mysqli_query($dbconn,$courseNameQuery);

while($row1 = mysqli_fetch_array($courseNames)){
    $options = $options. "<option value =\"$row1[0]\">".$row1[1]."</option>";
}

if (isset($_POST['SelectModule'])){
    $courseId = $_POST['courseName'];

    $questionOpts .= "<div class=\"form-group\">
                      <div class=\"col-sm-12\">
                      <label for=\"questions\" class=\"control-label\">Select Questions </label>
  	                  <select name=\"question\"  class=\"form-control\">";

    $selectQuestionQuery = " SELECT * FROM `test_question` WHERE `courseID`= $courseId";
    $selectResult = mysqli_query($dbconn,$selectQuestionQuery);
        while ($row2 = mysqli_fetch_array($selectResult)){
            $questionOpts .= "<option value =\"$row2[0]\">".$row2[1]."</option>";
        }
    $questionOpts.= "</select>
  	                   </div>
                      <button type='submit' class='btn btn-block btn-primary col-sm-12' name ='SelectQuestion' >Select Question</button>";
}

if(isset($_POST['SelectQuestion'])){

    $questionId =$_POST['question'];
    $_SESSION['questionId'] = $questionId;


    $selectQus = "SELECT `questionName` FROM `test_question` WHERE `questionID` = $questionId ";
    $selectQusResult = mysqli_query($dbconn,$selectQus);
    $row3 = mysqli_fetch_array($selectQusResult);

    $populateValue ="<form class=\"form-horizontal\" method=\"POST\">
                     <h4 class=\"$messageClass\">$msg</h4>
                     <div class='form-group'>
                     <div class='col-sm-12'>
                     <label for='ModuleName' class='control-label'>Question</label>
                     <input type='text' class='form-control' name ='question' placeholder='Question' value='".$row3[0]."'  required>
                     </div>
                     </div>";

    $selectAns = "SELECT `answerID` ,`answerName` FROM `test_answer` WHERE `questionID` =$questionId";
    $selectAnsResult = mysqli_query($dbconn,$selectAns);
    $i =1;
    while($row4 = mysqli_fetch_array($selectAnsResult)) {

        $populateValue .= "<div class='form-group'>
                           <div class='col-sm-12'>
                           <label for='AnswerOption' class='control-label'>Option" . $i . "</label>
                           <input type='text' class='form-control' name ='Value" . $i . "' id='" . $row4[0] . "' placeholder='Option " . $i . "' value='" . $row4[1] . "' required>
                           </div> ";

        $_SESSION['AnsId'.$i] = $row4[0];
        $i++;
    }
    $populateValue .="<div class='form-group'>
                       <div class='col-sm-12'>
                       <button type='submit' class='btn btn-block btn-primary' name ='updateQuestion'>Update</button>
                       </div>
                       </div>
                       </form>";

   $hideModule = "style='display:none'";

}
if (isset($_POST['updateQuestion'])) {
    $qus = $_POST['question'];
    $opt1Value = $_POST['Value1'];
    $opt2Value = $_POST['Value2'];
    $opt3Value = $_POST['Value3'];
    $opt4Value = $_POST['Value4'];

    $questionId = $_SESSION['questionId'];
    $Opt1Id = $_SESSION['AnsId1'];
    $Opt2Id = $_SESSION['AnsId2'];
    $Opt3Id = $_SESSION['AnsId3'];
    $Opt4Id = $_SESSION['AnsId4'];

    $updateQuestionQuery = "UPDATE `test_question` SET `questionName` = '$qus' WHERE `questionID` = $questionId ";
    $updateQuestionResult = mysqli_query($dbconn,$updateQuestionQuery) ;

    $updateOp1Query ="UPDATE `test_answer` SET `answerName` = '$opt1Value' WHERE `answerID` = $Opt1Id ";
    $updateOp1Result = mysqli_query($dbconn,$updateOp1Query);

    $updateOp2Query ="UPDATE `test_answer` SET `answerName` = '$opt2Value' WHERE `answerID` = $Opt2Id ";
    $updateOp2Result = mysqli_query($dbconn,$updateOp2Query);

    $updateOp3Query ="UPDATE `test_answer` SET `answerName` = '$opt3Value' WHERE `answerID` = $Opt3Id ";
    $updateOp3Result = mysqli_query($dbconn,$updateOp3Query);

    $updateOp4Query ="UPDATE `test_answer` SET `answerName` = '$opt4Value' WHERE `answerID` = $Opt4Id ";
    $updateOp4Result = mysqli_query($dbconn,$updateOp4Query);

    if(!$updateQuestionResult || !$updateOp1Result || !$updateOp2Result || !$updateOp3Result || !$updateOp4Result){
        $msg = 'Failed to Update';
        $messageClass = "alert alert-danger";
    }
    else{
        $msg = 'Updated Successfully !';
        $messageClass = "alert alert-success";
    }

}

$editModuleSelectCourseDisplay = "<form class=\"form-horizontal\" method=\"POST\"".$hideModule.">
                                    <h4 class=\"$messageClass\">$msg</h4>
                                    <div class=\"form-group\">
                                    <div class=\"col-sm-12\">
                                    <label for=\"coursename\" class=\"control-label\">Select Module </label>
  	                                <select name=\"courseName\"  class=\"form-control\">".$options.
                                    "</select>
  	                                </div>
  	                                </div>
                                    <div>
  	                                <button type='submit' class='btn btn-block btn-primary col-sm-12' name ='SelectModule' >Select Module</button>
                                    </div>
                                    <div>"
                                    .$questionOpts.
                                    "</div>
                                    </form>";


$dashboard->content = "
<div>
<h1> Edit Questions </h1>
</div>".$editModuleSelectCourseDisplay."
<div>"
  .$populateValue.
  "</div>
    ";
$dashboard->Display();
?>