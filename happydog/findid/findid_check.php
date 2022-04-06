<?php
session_start();
if(isset($_SESSION['id']))
{
  echo "<script>alert('아이디 찾기는 로그아웃 후 이용이 가능합니다.');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";
  exit;
}

//여기서는 일단 입력한 정보가 모두 올바른지 체크해야한다.
//이름 이메일 인증번호가 적절한가

$conn = mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");

// 이름과 이메일이 맞는지부터 체크

$sql_ck_db = "SELECT * FROM user WHERE name = '".$_POST['name']."' AND email ='".$_POST['email']."'";

$result = mysqli_query($conn, $sql_ck_db);

if(mysqli_num_rows($result) == 0)
{
  //존재하지 않으면 인증번호를 보내지 않고 끝냄
  echo "";
  exit;
}

//이름과 이메일이 맞다면 인증번호의 만료기간을 체크하자
//만료기간이 지났다면 인증번호의 기간이 끝났음을 알려주자

$sql_time = "SELECT * FROM findid WHERE email = '".$_POST['email']."'";
$result = mysqli_query($conn, $sql_time);
$time = mysqli_fetch_array($result,MYSQLI_ASSOC);


date_default_timezone_set('Asia/Seoul');
$curtime  = strtotime("Now");
$exp = strtotime($time['exp']);
//curtime 이 $exp보다 크면 만료되서 실패


if($curtime > $exp)
{
  //현재시간이 유효기간보다 큼 즉 만료기간을 지남
  //입력한 정보가 정확하지 않거나 인증번호가 만료되었습니다. 라는 alert가 뜬다
  echo "";
}
else
{
  //아직 만료기간을 지나지 않음
  //이제 입력한 인증번호와 db의 값을 비교해야한다.
  if($_POST['num'] == $time['rannum'])
  {
    //인증번호를 제대로 입력하면 db에서 인증번호 지워주고 true 반환
    $sql_del = "DELETE FROM findid WHERE email = '".$_POST['email']."'";
    mysqli_query($conn, $sql_del);
    echo $time['email'];
  }
  else
  {
    //인증번호를 잘못 입력한 경우
    echo "";
  }
}

?>
