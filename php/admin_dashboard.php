<?php
include('variables.php');
require("admin_page-template.php");

$dashboard = new Page();
$dashboard->H2 = "<div class='welcome'>Welcome $Adminname!</div>";
$dashboard->content = "<p></p>";
$dashboard->Display();
?>
