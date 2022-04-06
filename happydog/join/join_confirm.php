<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//인증메일 보낼떄 필요한 암호화 함수
function encrypt($string, $key) {
  $result = '';
  for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result .= $char;
  }
  return base64_encode($result);
}

function decrypt($string, $key) {
  $result = '';
  $string = base64_decode($string);
  for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result .= $char;
  }
  return $result;
}


  $mkey = "endrkendrk";

$url = $_HTTP_REFERER;
$conn =mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");

$sql_ck = "SELECT idno FROM user WHERE id = '".$_POST['user_id']. "' OR email = '" .$_POST['user_email']. "'";
$ck_result = mysqli_query($conn, $sql_ck);

//입력받은 id와 email와 데이터베이스에 중복되는 값이 있는지 검사
if(mysqli_num_rows($ck_result))
{
  //중복되는 값이 있는 경우
  echo "<script>alert('회원가입 실패(잘못된 요청입니다)');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";
}
else
{
  //중복되는 값이 없는 경우

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

  $mail->FromName= "---"; //보내는사람 이름

  // 받는사람메일주소 , 받는사람이름

  $mail->AddAddress($_POST['user_email'], $_POST['user_nickname']);

  $mail->Subject = $_POST['user_nickname']."님 안녕하세요! 해피도그 가입 인증 메일입니다."; // 메일 제목


  $auth_code = encrypt($_POST['user_id'].$mkey, "ekdrlendrl");

  $mail->Body = "해피도그 가입을 환영합니다.\n 아래 인증 페이지로 접속하시면 가입이 완료됩니다.\n http://localhost/happydog/join/join_email_confirm.php/?auth=". $auth_code; // 메일 내용

  $mail->Send(); // 실제로 메일을 보냄

  $sql = "INSERT INTO user (id, pw, name, email, created) VALUES ('".$_POST['user_id']. "', '" .$_POST['user_pw']. "', '" .$_POST['user_nickname']."', '" .$_POST['user_email']. "',  now()) ";
  $result = mysqli_query($conn, $sql);
  echo "<script>alert('회원가입 완료! 가입하신 이메일로 인증 메일을 발송했습니다');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";

} catch (phpmailerException $e) {

  echo $e->errorMessage();

} catch (Exception $e) {

  echo $e->getMessage();

}


}

// echo "<script>window.location='".$url."';</script>";
// header('Location: http://localhost/happydog/index.php');
 ?>
