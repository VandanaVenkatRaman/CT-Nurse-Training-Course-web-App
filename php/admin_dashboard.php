<?php
include('variables.php');
require('admin_page-template.php');

$dashboard = new Page();
$dashboard->H2 = "<div class='welcome text-left'>Welcome $Adminname!</div>";
$dashboard->content = "
<h2></h2>
<div id='dash-inx' class='dynamic-container'>
  <p>Using the panel on the left; you can add, delete and update course modules or questions.
  <br/><br/>
  You will also be able to run reports filtered on pass or fail and sorted by first name, last name, grade or course completion.</p>
</div>
";
$dashboard->Display();
?>
