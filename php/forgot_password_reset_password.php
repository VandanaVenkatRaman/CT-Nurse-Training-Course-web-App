  <?php
    ob_start();
    session_start();
    include 'dbh.php';
    $msg = '';

    $email = $_SESSION['username'];

     if (isset($_POST['submit'])) {
     $newpassword = $_POST['newpassword'];

     $query_updatepassword = "UPDATE user
                              SET password = '$newpassword'
                              WHERE email ='$email'" ;

     mysqli_query($dbconn,$query_updatepassword);
      header("Location: password_reset_successful.php");
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

      <link rel="stylesheet" href="../css/normalize.css">
      <link rel="stylesheet" href="../css/custom.css">

      <script type="text/javascript">

  function validatePassword() {
      var password = document.forms["updatepassword"]["newpassword"].value;
    var confirm_password = document.forms["updatepassword"]["reenterpassword"].value;
      if (password != confirm_password) {
          alert("Password Mismatch");
          return false;
      }
  }

  </script>
  </head>

  <body>

  <div class="container login-container">
    <div class="row-fluid">
        <img class="logo center-block" src="../images/ct-assoc-logo.png"/>
        <h1 class="text-center">Password Recovery </h1>
        <h4 class="text-center">Reset your password!</h4>
    </div>

    <div class="row-fluid">
    <div class="gray-bkgd container-padding border border-radius">

  <form name= "updatepassword" class="form-horizontal" action = "" onSubmit="return validatePassword()" method="POST">
  <!--h4 class="<?php echo $messageClass; ?>"><?php echo $msg; ?></h4> -->
    <div class="form-group">
      <div class="col-sm-12">
        <label for="inputPassword3" class="control-label">New Password</label>
        <input type="password" class="form-control" name ="newpassword" id="inputPassword3" placeholder="New Password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <label for="inputPassword3" class="control-label">Re-enter Password</label>
        <input type="password" class="form-control" name ="reenterpassword" id="inputPassword3" placeholder="Re-enter Password">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-12">
        <button type="submit" class="btn btn-block btn-primary" name ="submit">Submit</button>
      </div>
    </div>
  </form>
    </div>
    </div>

  </div>
  </body>
  </html
