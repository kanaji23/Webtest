<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if(isset($_SESSION['id']))
{
  echo "<script>alert('아이디 찾기는 로그아웃 후 이용이 가능합니다.');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";
  exit;
}

$conn = mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");


//입력받은 이름과 이메일에 해당하는 아이디가 데이터베이스에 있는지 확인
//있으면 다음단계로 없으면 인증번호를 보내지 않는다.

$sql_ck_db = "SELECT * FROM user WHERE name = '".$_POST['name']."' AND email ='".$_POST['email']."'";

$result = mysqli_query($conn, $sql_ck_db);

if(mysqli_num_rows($result) == 0)
{
  //존재하지 않으면 인증번호를 보내지 않고 끝냄
  echo "";
  exit;
}

$user = mysqli_fetch_array($result,MYSQLI_ASSOC);

//이미 인증번호가 발송되었는지 확인하는 쿼리 이미 발송됐으면 UPDATE 아니면 INSERT INTO
$sql_ck = "SELECT * FROM findid WHERE email ='". $_POST['email']."'";

$result = mysqli_query($conn, $sql_ck);

$rand_num = sprintf('%06d',rand(100000,999999)); //인증번호 6자리 난수 발생

if(mysqli_num_rows($result) == 0)
{
  //인증번호 발송이 처음인 경우
  $sql_send = "INSERT INTO findid VALUES ('".$_POST['email']."', ". $rand_num .", ADDTIME(now(), '00:01:00'))";
  mysqli_query($conn, $sql_send);
}
else
{
  $sql_send = "UPDATE findid SET rannum = '".$rand_num."', exp = ADDTIME(now(), '00:01:00') WHERE email = '".$_POST['email']."'";
  // echo $sql_send;
  // exit;
  mysqli_query($conn, $sql_send);
}

$sql_time = "SELECT exp FROM findid WHERE email = '".$_POST['email']."'";
$result = mysqli_query($conn, $sql_time);
$time = mysqli_fetch_array($result,MYSQLI_ASSOC);

//이메일 보내는 부분

require '../../PHPMailer-6.0.7/src/Exception.php';
require '../../PHPMailer-6.0.7/src/PHPMailer.php';
require '../../PHPMailer-6.0.7/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->IsSMTP();

try {


//메일서버나 인증에관련된 내용

$mail->Host = "smtp.gmail.com";  // 메일서버 주소

$mail->SMTPAuth = true; // SMTP 인증을 사용함

$mail->Port = 465; 	// email 보낼때 사용할 포트를 지정

$mail->SMTPSecure = "ssl";  // SSL을 사용함

$mail->Username = "---";  // 계정  [ ??? =gmail 메일주소 @앞부분]

$mail->Password ="---"; // 패스워드         [ ??? = gamil 계정 페스워드 ]

$mail->CharSet = 'utf-8';

$mail->Encoding = "base64";



//실제 메일에 관련된내용

$mail->From="---"; // 메일보내는사람 메일주소

$mail->FromName= "해피도그"; //보내는사람 이름

// 받는사람메일주소 , 받는사람이름

$mail->AddAddress($_POST['email'], $user['name']);

$mail->Subject = $user['name']."님 안녕하세요! 해피도그 아이디 찾기 인증번호입니다."; // 메일 제목

$mail->Body = "아래의 인증 번호를 입력해주세요.\n\n".$rand_num."\n\n인증번호 유효기간 : ". $time['exp'] . " 까지"; // 메일 내용

$mail->Send(); // 실제로 메일을 보냄

echo !"";

} catch (phpmailerException $e) {

echo $e->errorMessage();

} catch (Exception $e) {

echo $e->getMessage();

}

//일단 전달 값부터 확인하자

echo $_POST['name'] . " " . $_POST['email'] .$rand_num;



?>
