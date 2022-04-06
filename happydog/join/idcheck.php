<?php
$conn = mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");
if(isset($_POST['id']))
{
  $sql = "SELECT * FROM user WHERE id = '" .$_POST['id']. "'";
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
