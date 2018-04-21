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

while($row1 = mysqli_fetch_array($courseNames)){
    $options = $options. "<option value =\"$row1[0]\">".$row1[1]."</option>";
}

if (isset($_POST['Select'])){
    $courseId = $_POST['courseName'];

        $checkBoxOpt ='';
        $selectQuestionQuery = " SELECT * FROM `test_question` WHERE `courseID`='$courseId'";
        $selectResult = mysqli_query($dbconn,$selectQuestionQuery);
        while ($row2 = mysqli_fetch_array($selectResult)){
            $checkBoxOpt .= "<input type=\"checkbox\" name=\"selectedQus[]\" value=\"$row2[0]\">".$row2[1]."<br>";
        }
        $checkBoxOpt.= "<button type='submit' class='btn btn-block btn-primary col-sm-12' name ='Delete' >Delete Questions</button>";
}
if (isset($_POST['Delete'])){
   $qus = $_POST['selectedQus'];
    if(empty($qus)){
        $msg = 'You did not select any question to Delete';
        $messageClass = "alert alert-warning";
    }
    else {
        $count = count($qus);
        for( $i=0; $i<$count ; $i++){

            $deleteQuestionQuery = "DELETE FROM `test_question` WHERE `questionID` = $qus[$i] ";
            $deleteQuestionResult = mysqli_query($dbconn,$deleteQuestionQuery) ;

            $deleteAnsQuery ="DELETE FROM `test_answer` WHERE `questionID` = $qus[$i]";
            $deleteAnsResult = mysqli_query($dbconn,$deleteAnsQuery);

            if(!$deleteQuestionResult || !$deleteAnsResult){
                $msg = 'Failed to Delete the Question';
                $messageClass = "alert alert-danger";
            }
            else{
                $msg = 'Questions deleted Successfully !';
                $messageClass = "alert alert-success";
            }
        }
    }
}

$dashboard->content = "
<div>
<h1> Delete Questions </h1>
</div>
<form class=\"form-horizontal\" method=\"POST\">

  <h4 class=\"$messageClass\">$msg</h4>
    <div class=\"form-group\">
      <div class=\"col-sm-12\">
        <label for=\"coursename\" class=\"control-label\">Select Module </label>
  	    <select name=\"courseName\"  class=\"form-control\">".$options.
    "</select>	    
  	  </div>
  	</div>
  	
  <div>
  	<button type='submit' class='btn btn-block btn-primary col-sm-12' name ='Select' >Select</button>	
  </div>
  	
  <div>"
  .$checkBoxOpt.
 "</div>	
  </form>
    ";
$dashboard->Display();
?>