  <?php
     include("dbh.php");
     session_start();
     $query_ctschools = "SELECT * FROM `school`";
     $ct_schools = mysqli_query($dbconn,$query_ctschools);

     if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form
        $univflag = "Y";
  	     $schoolid = 46;
      $firstname = mysqli_real_escape_string($dbconn,$_POST['firstname']);
      $lastname = mysqli_real_escape_string($dbconn,$_POST['lastname']);
      $email = mysqli_real_escape_string($dbconn,$_POST['email']);
      $password = mysqli_real_escape_string($dbconn,$_POST['password']);
      $universityname = mysqli_real_escape_string($dbconn,$_POST['universityname']);
      $graduationyear = mysqli_real_escape_string($dbconn,$_POST['graduationyear']);
      $securityquestion = mysqli_real_escape_string($dbconn,$_POST['security_question']);
      $securityanswer = mysqli_real_escape_string($dbconn,$_POST['securityanswer']);
      $ctcollege = mysqli_real_escape_string($dbconn,$_POST['ctlist']);

      // Check if email Id already exists. If so, display error
      $checkUserExistsSql = "SELECT * FROM `user` WHERE `email` = '$email'";
      $resultcheckUserExistsSql =(mysqli_query($dbconn,$checkUserExistsSql));
      if ($row = mysqli_fetch_assoc($resultcheckUserExistsSql)){

      $msg = 'Email Id already registered.';
       $messageClass = "alert alert-danger";
      }
      else{
          if($ctcollege != 46) {
         $schoolid = $ctcollege;
         $univflag = "N";
         $universityname ="";
       }
          $sql = "INSERT INTO `user` (`email`, `password`, `firstName`, `lastName`, `securityQuestion`, `securityAnswer`, `graduationYear`, `isActive`, `createdBy`, `createdOn`, `updatedBy`, `updatedOn`, `universityFlag`, `otherUniversity`, `schoolID`)
              values ('$email', '$password', '$firstname', '$lastname', '$securityquestion', '$securityanswer', '$graduationyear', 'y' ,'$firstname', NOW(), '$firstname', NOW(), '$univflag', '$universityname','$schoolid')";

       if (!mysqli_query($dbconn,$sql)){
          //echo("Error description: " . mysqli_error($dbconn));
      $msg = 'Error adding User';
       $messageClass = "alert alert-danger";
       }else{
        header("location: welcome.php");
     }

      }

     }
  ?>


  <!DOCTYPE html>
  <html lang="en">
  <head>
      <title>Nursing Test Registration</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-route.js"></script>

      <link rel="stylesheet" href="../css/normalize.css">
      <link rel="stylesheet" href="../css/custom.css">
  <script type="text/javascript">
  function CheckCollege(val){
   var element=document.getElementById('college');
   if(val==46)
     element.style.display='block';
   else
     element.style.display='none';
  }


  function validatePassword() {
      var password = document.forms["reg"]["password"].value;
  	var confirm_password = document.forms["reg"]["cpassword"].value;
      if (password != confirm_password) {
          alert("Password Mismatch");
          return false;
      }
  }

  </script>

  </head>

  <body>

  <div class="container-fluid login-container">
    <div class="row-fluid">
        <img class="logo center-block" src="../images/ct-assoc-logo.png"/>
        <h1 class="text-center">Nursing Online Training Application</h1>
        <h2 class="text-center">Registration</h2>
    </div>

    <div class="row-fluid">
    <div class="gray-bkgd container-padding border border-radius">

  <form name= "reg" class="form-horizontal" action = "" onSubmit="return validatePassword()" method = "post">
    <h4 class="<?php echo $messageClass; ?>"><?php echo $msg; ?></h4>
    <div class="form-group">
      <div class="col-sm-12">
        <label for="fname" class="control-label">First Name</label>
        <input type="text" class="form-control" name = "firstname" id="fname" placeholder="First Name" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <label for="lname" class="control-label">Last Name</label>
        <input type="text" class="form-control" name = "lastname" id="lname" placeholder="Last Name" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-12">
        <label for="email" class="control-label">Email</label>
        <input type="email" class="form-control" name = "email" id="email" placeholder="Email" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-12">
        <label for="pwd" class="control-label">Password</label>
        <input type="password" class="form-control" name = "password" id="pwd" placeholder="Password" required>
      </div>
    </div>

      <div class="form-group">
      <div class="col-sm-12">
        <label for="cpwd" class="control-label">Confirm Password</label>
        <input type="password" class="form-control" name = "cpassword" id="cpwd" placeholder="Password" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-12">
        <label for="college" class="control-label">Select University</label>
  	    <select name="ctlist"  class="form-control"  onchange='CheckCollege(this.value);'>
            <?php while($row1 = mysqli_fetch_array($ct_schools)):;?>
  		  <option value = "<?php echo $row1[0];?>"> <?php echo $row1[1]; ?></option>
  		  <?php endwhile;?>
       <!--     <option value= "others">others</option> -->
         </select>
        <input type="text" class="form-control" name = "universityname" id="college" placeholder="University" style='display:none;'>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-12">
        <label for="yog" class="control-label">Graduation Year</label>
        <input type="number" class="form-control" name = "graduationyear" id="year" placeholder="Year" min = 1990 required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-12">
        <label for="sq" class="control-label">Securtiy Question</label>
  	  <select class="form-control" name = "security_question" id="year" placeholder="" > <br>
  		<option value="What was the make and model of your first car?">What was the make and model of your first car?</option>
  		<option value="What is the first name of your best friend in high school?">What is the first name of your best friend in high school?</option>
  		<option value="In what city did you meet your spouse/boy friend?">In what city did you meet your spouse/boy friend?</option>
  		<option value="What was the name of your elementary / primary school?">What was the name of your elementary / primary school?</option>
  		<option value="What was your childhood nickname?">What was your childhood nickname?</option>
  		<option value="What was your mother's maiden name?">What was your mother's maiden name?</option>
  		<option value="What was your favourite sport?">What was your favourite sport? </option>
  	   </select>
      </div>
    </div>

     <div class="form-group">
      <div class="col-sm-12">
        <label for="sa" class="control-label">Security Answer</label>
        <input type="text" class="form-control" name = "securityanswer" id="securityanswer" placeholder="" required>
      </div>
    </div>



    <div class="form-group">
      <div class="col-sm-12">
        <button type="submit" class="btn btn-block btn-primary">Submit</button>
      </div>
    </div>
  </form>

    </div>
    </div>


  <div class="row-fluid padding-top">
    <div class="container-padding border border-radius">
      <p class="no-margin">Already Registered?&nbsp;<a href="login.php">Login &rarr;</a></p>
    </div>
  </div>


  </div>


  </body>

  </html
