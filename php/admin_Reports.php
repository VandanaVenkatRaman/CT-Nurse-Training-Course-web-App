<?php
include("dbh.php");
require("admin_page-template.php");

session_start();
$dashboard = new Page();
$emailId = $_SESSION['email'];

$whereClause = "";
if (isset($_POST['Submit'])){
    $sortBy = $_POST['sortBy'];
    $filterBy = $_POST['filterBy'];

    if($filterBy == 'pass' ){
        $whereClause .= " AND R.`status` ='Pass'";

    }
    else if($filterBy == 'fail' ){
        $whereClause .= " AND R.`status` ='Fail'";

    }
    if($sortBy == 'firstName'){
        $whereClause .= " ORDER BY U.`firstName` ASC";
    }
    else if($sortBy == 'lastName'){
        $whereClause .= " ORDER BY U.`lastName` ASC";

    }
    else if($sortBy == 'Grade'){
        $whereClause .= " ORDER BY R.`score` DESC";

    }
    else if($sortBy == 'endDate'){
        $whereClause .= " ORDER BY R.`endDate` ASC";

    }
}

$selectCourseReportQuery = "SELECT U.`firstName`, U.`lastName` , R.`email`, R.`endDate`, R.`score`, R.`status` FROM `user` U, `user_courseCompletion_result` R WHERE U.`email` = R.`email`".$whereClause;

$selectCourseResult = mysqli_query($dbconn,$selectCourseReportQuery);

$html = "";
while( $row = mysqli_fetch_array($selectCourseResult)){
$html .= "<tr>";
$html .= "<td>".$row[0]."</td>";
$html .= "<td>".$row[1]."</td>";
$html .= "<td>".$row[2]."</td>";
$html .= "<td>".$row[3]."</td>";
$html .= "<td>".$row[4]."</td>";
$html .= "<td>".$row[5]."</td>";
$html .= "</tr>";
}

$dashboard->content = "
<div> 
<h1> Report </h1>
</div>
<form class=\"form-horizontal\" method=\"POST\">
 <div class='form-group'>
      <div class='col-sm-12'>
        <label for='sortBy' class='control-label'>SORT BY</label>
  	    <select name='sortBy'>
  	        <option value =''>SELECT</option>
  	        <option value ='firstName'>First Name</option>
  	        <option value ='lastName'>Last Name</option>
  	        <option value ='Grade'>Grade</option>
  	        <option value ='endDate'>Course Completion Date</option>
  	    </select>
  	    <label for='filterBy' class='control-label'>FILTER BY</label>
  	    <select name='filterBy'>
  	    <option value =''>SELECT</option>
  	        <option value ='pass'>Pass</option>
  	        <option value ='fail'>Fail</option>
        </select>
                <button type='submit' class='btn btn-block btn-primary col-sm-2' name ='Submit' >Apply</button>
  	  </div>
 </div>
 </form>
 <div>
 <table id ='tablestyle'>
 <tr>
 <th> First Name</th>
 <th> Last Name</th>
 <th> Email</th>
 <th> Course Completion Date</th>
 <th> Grade</th>
 <th> Status</th>
</tr>"
.$html.
"</table>
</div>
";
$dashboard->Display();
?>

