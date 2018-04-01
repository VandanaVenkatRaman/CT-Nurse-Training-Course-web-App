<?php
	include('variables.php');
	require("page-template.php");

	$faq = new Page();
	$faq->H2 = "Frequently Asked Questions";
	$faq->content = "<h4>Question 1?</h4>
									<p>we will ask the client for this information.</p>
									<h4>Question 2?</h4>
									<p>we will ask the client for this information.</p>
									<h4>Question 3?</h4>
									<p>we will ask the client for this information.</p>";
	$faq->Display();
?>
