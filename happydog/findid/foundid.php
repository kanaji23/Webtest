<?php
session_start();
if(!isset($_POST['chck']))
{
  echo "<script>alert('잘못된 접근입니다.');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";
  exit;
}
if(isset($_SESSION['id']))
{
  echo "<script>alert('아이디 찾기는 로그아웃 후 이용이 가능합니다.');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";
  exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$conn = mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");
$sql = "SELECT * FROM user WHERE email = '".$_POST['chck']."'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <meta name="viewport" content="width-device-width" initial-scale="1">
     <link rel="stylesheet" href="/happydog/css/happydog.css">
     <title>아이디 찾기 - 해피도그</title>

   </head>
   <body>
     <div class="logo" align="center">
       <h1>
         <a href="/happydog/index.php">해피도그</a>
       </h1>
     </div>

     <div align="center">
       <p><?=$row['name']?>님의 아이디입니다.</p>
       <p><?=$row['id']?> (<?=$row['created']?> 가입)</p>
       <table>
         <tr>
           <td >
             <button class="btn50" type="button" onclick="location.href='/happydog/login/login.php'">로그인</button>
           </td>
           <td >
             <button class="btn50" type="button" name="button">비밀번호 재설정</button>
           </td>
         </tr>
       </table>
     </div>
   </body>
 </html>
