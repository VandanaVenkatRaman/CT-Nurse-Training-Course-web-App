<?php
  include('variables.php');
	require("page-template.php");

	$inx1template = new Page();
	$inx1template->H2 = "Course ID, Name, Descrip | Instructions";
	$inx1template->content = "

  <p>This should really be made into a single instructions template where the URL is uploaded by the admin to a field in the database and the URL is pulled into the iframe</p>
  <iframe src='https://my.visme.co/projects/dmvvdg0k-6ep5dm1gwej75dz3#s1' height='600px' width='100%'></iframe>

  ";
	$inx1template->Display();

?>
