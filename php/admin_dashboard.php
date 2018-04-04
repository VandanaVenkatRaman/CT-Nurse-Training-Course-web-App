<?php
include('variables.php');
require("admin_page-template.php");

$dashboard = new Page();
$dashboard->H2 = "Welcome $Adminname!";
$dashboard->content = "<p></p>";
$dashboard->Display();
?>
