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

    }else if($sortBy == 'grad'){
        $whereClause .= " ORDER BY U.`graduationYear` DESC";

    }else if($sortBy == 'school'){
        $whereClause .= " ORDER BY schoolName ASC";

    }
}

$selectCourseReportQuery = "SELECT U.`firstName`, U.`lastName` , U.`graduationYear`,R.`email`, R.`endDate`, R.`score`, R.`status` , 
                            CASE
                            WHEN S.schoolID = 46 THEN U.otherUniversity
                            WHEN S.schoolID != 46 THEN S.schoolName
                            END 
                            AS schoolName
                            FROM `user` U 
                            INNER JOIN `user_coursecompletion_result` R ON U.`email` = R.`email`
                            INNER JOIN `school` S ON U.`schoolId` = S.`schoolId`
".$whereClause;

$selectCourseResult = mysqli_query($dbconn,$selectCourseReportQuery);

$html = "";
while( $row = mysqli_fetch_array($selectCourseResult)){
$html .= "<tr>";
$html .= "<td>".$row[0]."</td>";
$html .= "<td>".$row[1]."</td>";
$html .= "<td>".$row[7]."</td>";
$html .= "<td>".$row[2]."</td>";
$html .= "<td>".$row[3]."</td>";
$html .= "<td>".$row[4]."</td>";
$html .= "<td>".$row[5]."</td>";
$html .= "<td>".$row[6]."</td>";
}

$dashboard->content = "

<h2> Report View: Completed Courses </h2>

<div class='dynamic-container'>
<form class=\"form-horizontal\" method=\"POST\">
 <div class='form-group'>
      <div class='col-sm-12'>
        <label for='sortBy' class='control-label'>SORT BY</label>
  	    <select name='sortBy'>
  	        <option value =''>SELECT</option>
  	        <option value ='firstName'>First Name</option>
            <option value ='lastName'>Last Name</option>
            <option value ='school'>School</option>
            <option value ='grad'>Graduation Year</option>
            <option value ='Grade'>Grade</option>
            <option value ='endDate'>Course Completion Date</option>
  	    </select>
  	    <label for='filterBy' class='control-label'>FILTER BY</label>
  	    <select name='filterBy'>
  	    <option value =''>SELECT</option>
  	        <option value ='pass'>Pass</option>
  	        <option value ='fail'>Fail</option>
        </select>
                <button id='report-btn' type='submit' class='btn btn-block btn-primary col-sm-2' name ='Submit'>Apply</button>
  	  </div>
 </div>
 </form>
 <p>&nbsp;</p>
 <div id='report'>
 <table id='tablestyle'>
 <tr>
 <th> First Name</th>
 <th> Last Name</th>
 <th> School</th>
 <th> Graduation Year</th>
 <th> Email</th>
 <th> Course Completion Date</th>
 <th> Grade</th>
 <th> Status</th>
</tr>"
.$html.
"</table>
</div>

</div>

";
$dashboard->Display();
?>
