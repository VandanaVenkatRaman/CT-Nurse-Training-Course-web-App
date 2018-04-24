<?php
  include('variables.php');
  include('dbh.php');
  include('courses.php');
	require("page-template.php");

	$dashboard = new Page();
	$dashboard->H2 = "<div class='welcome text-left'>Welcome $firstname!</div>";
	$dashboard->content = "
 <h2 id='pageHeader'></h2>
  <div id='dash-inx' class='dynamic-container'>
    <p>Please select a course module from the left panel.  Questions and Answers are randomly shuffled.
    <br/><br/>
    You will only be allowed 3 attempts at each course module before the module is closed off.</p>
  </div>

 <div id='dashboardContent'>
  <div class='content mt-3' id='quiz' style='display:none;''>
      <h4 id='mandatoryQuestionAnswer' class='alert alert-danger' style='display: none;''>You have not answered all the questions</h4>
      <h4 id='questionAndAnswerResult' class='alert' style='display: none;''></h4>
      <div id='questionsAndAnswers' class='text-dark col-md-12'></div>
      <div class='form-group'>
          <div class='col-sm-12'>
              <button type='submit' id='submitQuizAns' class='btn btn-block btn-primary' name ='submit'>Submit</button>
          </div>
      </div>
  </div>

  <div class='content mt-3' id='instructions' style='display: none;'>
    <div class='dynamic-container'>
    </div>
  </div>

  <div class='content mt-3' id='profile' style='display: none;'>
    <div class='dynamic-container x1-2'>
      <span id ='fname'></span><br/>
      <span id ='lname'></span><br/>
      <span id ='emailaddress'></span><br/>
      <br/>
      <span id ='univName'></span><br/>
      <span id ='gradYear'></span>
    </div>
  </div>
</div>
  ";
	$emailId = $_SESSION['email'];
	$courses = getCourseMaterial($emailId,$dbconn);
//	$dashboard->Display();
	$dashboard->Display($courses);
?>
