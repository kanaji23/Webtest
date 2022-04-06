<?php
session_start();
//로그인 상태면 경고문 띄우고 메인페이지로 보낸다.
if(isset($_SESSION['id']))
{
  echo "<script>alert('로그인은 로그아웃 후 이용이 가능합니다.');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width" initial-scale="1">
    <link rel="stylesheet" href="/happydog/css/happydog.css">
    <title>로그인 - 해피도그</title>
  </head>
  <body>
    <header>
    <div class="logo" align="center">
      <h1>
        <a href="/happydog/index.php">해피도그</a>
      </h1>
    </div>

    <script>

    function idcheck()
    {
      var form = document.loginform;
      //입력값이 없으면
      console.log(form.id.value);
      if(!form.id.value)
      {
        document.querySelector('.id_no_value').style.display='block';
        return false;
      }
      else
      {
            document.querySelector('.id_no_value').style.display='none';
            return true;
      }
    }

    function pwcheck()
    {
      var form = document.loginform;
      //입력값이 없으면
      console.log(form.pw.value);
      if(!form.pw.value)
      {
        document.querySelector('.pw_no_value').style.display='block';
        return false;
      }
      else
      {
            document.querySelector('.pw_no_value').style.display='none';
            return true;
      }
    }

    function sign()
    {
      var form = document.loginform;

      if(idcheck())
      {
        if(pwcheck())
        {
          form.submit();
        }
        else {
          form.pw.focus();
        }
      }
      else {
        form.id.focus();
      }
    }


    </script>

    </header>

<div align="center">
  <div class="loginbox" align="left">
    <form  name="loginform" action="login_check.php" method="post">
      <h2>로그인</h2>
      <p>
        <input type="text" name="id" placeholder="아이디" class="edittext"
        onfocus="idcheck();" onblur="idcheck();">
      </p>
      <p class="id_no_value" style="color:red; display:none;">
          아이디를 입력해주세요.
      </p>
      <p>
        <input type="password" name="pw" placeholder="비밀번호" class="edittext"
          onfocus="pwcheck();" onblur="pwcheck();">
      </p>
      <p class="pw_no_value" style="color:red; display:none;">
         비밀번호를 입력해주세요.
      </p>

      <?php
        $url = $_SERVER['HTTP_REFERER'];
        echo "<input type='hidden' name='url' value='".$url."'><br> ";

       ?>

      <div class="login_option">
        <div class="ck_auto">
          <label>  <input type="checkbox" name="autologin" value="1">자동 로그인</label>
        </div>
        <div class="find_info">
          <a href="/happydog/findid/findid.php" class="find_id">아이디</a> /
          <a href="#" class="find_pass">비밀번호 찾기</a>
        </div>
      </div>

<br><br><hr><br>

      <p>
        <button class="btn" type="button" onclick="sign();" >로그인</button>
      </p>

      <p>
        <button class="btn" type="button" onclick="location.href='/happydog/join/agreement.php'">회원가입</button>
      </p>


    </form>
  </div>
</div>



  </body>
</html>
