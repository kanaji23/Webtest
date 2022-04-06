<?php

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

  //해독된 사용자의 아이디
  $auth_code = str_replace($mkey, '', decrypt($_GET['auth'], "ekdrlendrl"));

  $conn =mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");
  $sql = "SELECT email_auth FROM user WHERE id = '{$auth_code}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);


  //코드가 유효하지 않아서 검색 결과가 없을 경우엔 유효하지 않은 접근이라고 알려준다.
  if($row < 1)
  {
?>
<table border="1px solid black" style="width:50%; margin:0 auto; text-align:center;">
  <tr>
    <th>유효하지 않은 접근입니다.</th>
  </tr>
  <tr>
    <th>
      <button type="button" onclick="location.href='http://localhost/happydog/index.php'">해피도그 홈으로 가기</button>
    </th>
  </tr>
</table>

<?
  exit;
  }
  if($row['0'])
  {
    //해당 아이디의 이메일 인증이 이미 완료 되었으면
?>

      <table border="1px solid black" style="width:50%; margin:0 auto; text-align:center;">
        <tr>
          <th>이미 이메일 인증이 완료된 회원입니다.</th>
        </tr>
        <tr>
          <th>
            <button type="button" onclick="location.href='http://localhost/happydog/index.php'">해피도그 홈으로 가기</button>
          </th>
        </tr>
      </table>

<?
  }
  else
  {
     $sql_auth = "UPDATE user SET email_auth = 1 WHERE id = '{$auth_code}'";

     if(mysqli_query($conn, $sql_auth))
     {
       //쿼리 실행이 성공하면
?>
        <table border="1px solid black" style="width:50%; margin:0 auto; text-align:center;">
          <tr>
            <th>인증이 완료되었습니다! 이제 정상적으로 해피도그의 서비를 이용할 수 있습니다.</th>
          </tr>
          <tr>
            <th>
              <button type="button" onclick="location.href='http://localhost/happydog/index.php'">해피도그 홈으로 가기</button>
            </th>
          </tr>
        </table>
<?

     }
     else
     {
          echo "쿼리오류";
     }


  }

 ?>
