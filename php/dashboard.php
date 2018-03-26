<?php
  include('variables.php');
	require("page-template.php");

	$dashboard = new Page();
	$dashboard->H2 = "Welcome $firstname!";
	$dashboard->content = "<p>Please choose a quiz from the assigned courses section.</p>";
	$dashboard->Display();
?>
