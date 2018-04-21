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

if (isset($_POST['removeCourse'])){
    $courseName = $_POST['courseName'];

    $DeleteCourseQuery = "DELETE FROM `course_section` WHERE `courseName` = '$courseName'";
    $DeleteResult = mysqli_query($dbconn,$DeleteCourseQuery);

    if(!$DeleteResult) {
        $msg = 'Failed to Delete the course '.$courseName;
        $messageClass = "alert alert-danger";
    }
    else{
        $msg = $courseName.' Course Removed Successfully !';
        $messageClass = "alert alert-success";
    }
}
$options = "<option value =\"\">SELECT</option>";
while($row1 = mysqli_fetch_array($courseNames)){
    $options = $options. "<option value =\"$row1[1]\">".$row1[1]."</option>";
}
$dashboard->content = "
<div>
<h1> Delete Module </h1>
</div>
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
        <button type=\"submit\" class=\"btn btn-block btn-primary\"name =\"removeCourse\" >Delete Module</button>
      </div>
    </div>
  </form>
    ";
$dashboard->Display();
?>