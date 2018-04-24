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

if (isset($_POST['Module'])){
    $moduleName = $_POST['moduleName'];
    $moduleDesc = $_POST['moduleDescription'];
    $moduleVideo = $_POST['moduleVideoLink'];

    $UpdateModuleQuery = "UPDATE `course_section`
                          SET `courseDescription` = '$courseDesc',`courseDocument` = '$courseVideo' , `updatedBy` = '$emailId', `updatedOn` = now()
                          WHERE `courseName` = '$courseName'";
    $UpdateResult = mysqli_query($dbconn,$UpdateModuleQuery);

    if(!$UpdateResult) {
        $msg = 'Failed to Edit the Module '.$moduleName;
        $messageClass = "alert alert-danger";
    }
    else{
        $msg = $moduleName.' Updated Successfully!';
        $messageClass = "alert alert-success";
    }
}
$options = "<option value =\"\">SELECT</option>";
while($row1 = mysqli_fetch_array($courseNames)){
    $options = $options. "<option value =\"$row1[1]\">".$row1[1]."</option>";
}
$dashboard->content = "

<h2> Edit Module </h2>

<div id='admin' class='dynamic-container'>
<form class=\"form-horizontal\" method=\"POST\">

  <h4 class=\"$messageClass\">$msg</h4>
    <div class=\"form-group\">
      <div class=\"col-sm-12\">
        <label for=\"moduleName\" class=\"control-label\">Select Module</label>
  	    <select required name=\"moduleName\"  class=\"form-control\">".$options.
    "</select>
  	  </div>
  	</div>
  	<div class=\"form-group\">
    <div class=\"col-sm-12\">
      <label for=\"moduleDesc\" class=\"control-label\">Module Description</label>
      <input type=\"text\" class=\"form-control\" name =\"moduleDescription\" id=\"moduleDesc\" placeholder=\"Module description\" required>
    </div>
  </div>
  <div class=\"form-group\">
    <div class=\"col-sm-12\">
      <label for=\"VideoLink\" class=\"control-label\">Module Video Link</label>
      <input type=\"text\" class=\"form-control\" name =\"moduleVideoLink\" id=\"VideoLink\" placeholder=\"module Video Link\" required>
    </div>
  </div>
    <div class=\"form-group\">
      <div class=\"col-sm-12\">
        <button type=\"submit\" class=\"btn btn-block btn-primary\"name =\"updateModule\" >Update Module</button>
      </div>
    </div>
  </form>
<p>&nbsp;</p>
</div>
    ";
$dashboard->Display();
?>
