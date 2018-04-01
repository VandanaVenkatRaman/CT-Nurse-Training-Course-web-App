<?php
  include('variables.php');
	require("page-template.php");

	$quiztemplate = new Page();
	$quiztemplate->H2 = "Please answer the questions below:";
	$quiztemplate->content = "

  <div class='content mt-3' id='quiz' style='display:none;''>
      <h4 id='mandatoryQuestionAnswer' class='alert alert-danger' style='display: none;''>You have not answered all the questions</h4>
      <h4 id='questionAndAnswerResult' class='alert alert-info' style='display: none;''></h4>
      <div id='questionsAndAnswers' class='text-dark col-md-12'>
      </div>
      <div class='form-group'>
          <div class='col-sm-12'>
              <button type='submit' id='submitQuizAns' class='btn btn-block btn-primary' name ='submit'>Submit</button>
          </div>
      </div>
  </div>

  ";

  $quiztemplate->footerinclude = "../include/footer-quiz-template.txt";

	$quiztemplate->Display();

?>
