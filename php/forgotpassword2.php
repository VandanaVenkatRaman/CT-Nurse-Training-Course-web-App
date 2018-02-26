<?php
  ob_start();
  session_start();
  include 'dbh.php';
  $msg = '';

  $email = $_SESSION['username'];
  $query_securityquestion = "SELECT securityQuestion FROM user WHERE email ='$email'";
  $securityquestion_result = mysqli_query($dbconn,$query_securityquestion); 
  

   if (isset($_POST['next']) && !empty($_POST['answer'])) {
    $ans = $_POST['answer'];

    $query_validateanswer = "SELECT * FROM user WHERE email='$email' AND securityAnswer='$ans'";
    $validateanswerresult = mysqli_query($dbconn,$query_validateanswer);  

    if(!$row = mysqli_fetch_assoc($validateanswerresult)){
     $msg = 'Invlid Answer';
     $messageClass = "alert alert-danger";

   } else {
     $_SESSION['valid'] = true;
     $_SESSION['timeout'] = time();
     //$_SESSION['email'] = $_POST['email'];
       
     $messageClass = "alert alert-success";
     header("location: forgotpassword3.php");
   }
  } 
  else{
    $messageClass = "none";
   $msg = "";
  } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Connecticut Nurses Training Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-route.js"></script>

    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/custom.css">
</head>

<body>

<div class="container login-container">
  <div class="row-fluid">
      <img class="logo center-block" src="/images/ct-assoc-logo.png"/>
      <h1 class="text-center">Password Recovery </h1>
      <h3 class="text-center">Security Question </h3>
  </div>

  <div class="row-fluid">
  <div class="gray-bkgd container-padding border border-radius">

<form class="form-horizontal" method="POST">
  <h4 class="<?php echo $messageClass; ?>"><?php echo $msg; ?></h4>
  <div class="form-group">
    <div class="col-sm-12">
      <div>
      <?php $fetchresult = mysqli_fetch_array($securityquestion_result);
      echo $fetchresult[0]; ?>
    </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12">
      <label for="answer" class="control-label"></label>
      <input type="text" class="form-control" name = "answer" id="answer" placeholder="answer" required>
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-12">
      <button type="submit" class="btn btn-block btn-primary" name ="next">Next</button>
    </div>
  </div>
</form>
  </div>
  </div>

</div>
</body>
</html
