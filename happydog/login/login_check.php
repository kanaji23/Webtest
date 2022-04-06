<?php
session_start();
$id=$_POST['id'];
$pw=$_POST['pw'];
$url = $_POST['url'];
$conn = mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");

$sql = "SELECT * FROM user WHERE id = '$id'";
$result = $conn->query($sql);
// row 가 존재하면
if($result->num_rows == 1)
{
  // $row = $result -> fetch_array(MYSQLI_ASSOC);
  $row = $result->fetch_array(MYSQLI_ASSOC);
  //password correct
  if($row['pw'] == $pw)
  {

    if($row['email_auth'] == 0)
    {
      echo "<script>alert('".$row['email']."로 이메일 인증을 완료해주세요.');</script>";
      echo "<script>window.location='/happydog/login/login.php';</script>";
      exit;
    }
    $_SESSION['id'] = $id;
    $_SESSION['idno'] = $row['idno'];
    $_SESSION['isadmin'] = $row['isadmin'];
    $_SESSION['nickname'] = $row['name'];
    $_SESSION['email'] = $row['email'];
    if(isset($_SESSION['id']))
    {
      //자동로그인체크면 쿠키생성
      if(isset($_POST['autologin']))
      {
        $master_key = "kadfadi";
        $hash = md5($master_key.$pw);
        setcookie("user_id_cookie", $id, time() + (86400 * 30), "/" );
        setcookie("user_hash_cookie", $hash, time() + (86400 * 30), "/" );
      }
      // header('Location: ./index.php'); //login success
      header('Location:' .$url.'');
    }
    else
    {
      echo "<script>alert('세션 저장 실패');</script>";
      // echo "<script>window.location='http://localhost/happydog/login.php';</script>";
      echo "<script>window.location='/happydog/login/login.php';</script>";
    }
  }
  else
  {
    echo "<script>alert('로그인 실패 1- 아이디, 비밀번호를 확인해주세요');</script>";
    echo "<script>window.location='/happydog/login/login.php';</script>";
  }
}
else
{
  echo "<script>alert('로그인 실패 2- 아이디, 비밀번호를 확인해주세요');</script>";
  echo "<script>window.location='/happydog/login/login.php';</script>";
}
 ?>
