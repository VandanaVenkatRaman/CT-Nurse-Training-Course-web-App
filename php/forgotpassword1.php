<?php
  ob_start();
  session_start();
  include 'dbh.php';
  $msg = '';

   if (isset($_POST['next']) && !empty($_POST['email'])) {

   $uname = $_POST['email'];
   $sql = "Select * from user where uid='$uname'";
   $result = mysqli_query($dbconn,$sql);   

   if(!$row = mysqli_fetch_assoc($result)){
     $msg = 'Email not registered';
     $messageClass = "alert alert-danger";

   } else {
     $_SESSION['valid'] = true;
     $_SESSION['timeout'] = time();
     $_SESSION['username'] = $_POST['email'];
      // $msg = 'You have entered valid use name and password';
     $messageClass = "alert alert-success";
     header("Location: forgotpassword2.php");
   } 
} else {
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
      <h4 class="text-center">Enter your registered email id to recover your password</h4>
  </div>

  <div class="row-fluid">
  <div class="gray-bkgd container-padding border border-radius">

<form class="form-horizontal" method="POST">
  <h4 class="<?php echo $messageClass; ?>"><?php echo $msg; ?></h4>
  <div class="form-group">
    <div class="col-sm-12">
      <label for="inputEmail3" class="control-label">Email</label>
      <input type="email" class="form-control" name ="email" id="inputEmail3" placeholder="Email" required>
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
