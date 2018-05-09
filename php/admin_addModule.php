<?php

include("dbh.php");
require("admin_page-template.php");
session_start();
$dashboard = new Page();
$emailId = $_SESSION['email'];
$msg = '';

if (isset($_POST['add'])){

    $moduleName = $_POST['moduleName'];
    $moduleDesc = $_POST['moduleDescription'];
    $url = $_POST['moduleVideoLink'];

    $selectModuleQuery ="SELECT `courseName` FROM `course_section` WHERE `courseName` = '$moduleName'";
    $selectResult = mysqli_query($dbconn,$selectModuleQuery);
    if(!$row = mysqli_fetch_assoc($selectResult)){
        $insertModuleQuery = "INSERT INTO `course_section`(`courseName`,`courseDescription`,`courseDocument`,`createdBy` ,`createdOn` ,`updatedBy`,`updatedOn`)
                          VALUES('$moduleName' , '$moduleDesc' ,'$url','$emailId',now(),'$emailId',now())";
        $result = mysqli_query($dbconn,$insertModuleQuery);

        if(!$result) {
            $msg = 'Failed to add the module '.$moduleName;
            $messageClass = "alert alert-danger";
        }
        else{
            $msg = $moduleName.' Module Added Successfully!';
            $messageClass = "alert alert-success";
        }
    }
 else{
     $msg = $moduleName.' Already exists!';
     $messageClass = "alert alert-danger";

}

}
$dashboard->content = "

<h2> Add New Module </h2>

<div id='admin' class='dynamic-container'>
  <div class=\"row-fluid margin-top\">
<form class=\"form-horizontal\" method=\"POST\">
  <h4 class=\"$messageClass\">$msg</h4>
  <div class=\"form-group\">
    <div class=\"col-sm-12\">
      <label for=\"ModuleName\" class=\"control-label\">Module Name</label>
      <input type=\"text\" class=\"form-control\" name =\"moduleName\" id=\"moduleName\" placeholder=\"Module name\" required>
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
      <input type=\"text\" class=\"form-control\" name =\"moduleVideoLink\" id=\"VideoLink\" placeholder=\"Module Video Link\" required>

    </div>
  </div>
  <div class=\"form-group\">
    <div class=\"col-sm-12\">
      <button type=\"submit\" class=\"btn btn-block btn-primary\" name =\"add\">Add Module</button>
    </div>
  </div>
</form>
  </div>
<p>&nbsp;</p>
</div>
";

$dashboard->Display();
?>
