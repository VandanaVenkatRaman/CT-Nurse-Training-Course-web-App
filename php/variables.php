<?php
  session_start();
  include 'dbh.php';

  $uname = $_SESSION["email"];

  $sql_name = "SELECT firstName FROM user WHERE email='$uname'";
  $sql_email = "SELECT email FROM user WHERE email='$uname'";

  $name_result = $dbconn->query($sql_name);
  $email_result = $dbconn->query($sql_email);

?>

<?php if ($name_result->num_rows > 0) {
      // output data of each row
      while ($row = $name_result->fetch_assoc()) {
      $firstname = $row["firstName"];
            }
      }
?>
