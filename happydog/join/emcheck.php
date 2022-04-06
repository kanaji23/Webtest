<?php
$conn = mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");
if(isset($_POST['email']))
{
  $sql = "SELECT * FROM user WHERE email = '" .$_POST['email']. "'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0)
  {
    echo !"";
  }
  else {
    echo "";
  }
}
 ?>
