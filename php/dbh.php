<?php

$dbconn = mysqli_connect("localhost","nursesapp","fairfield","NursesTrainingApp");
 if(!$dbconn){
	 die("Connection failed:" .mysqli_connect_error());
 }
 ?>
