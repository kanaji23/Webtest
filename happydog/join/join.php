<?php
session_start();
//로그인 상태면 경고문 띄우고 메인페이지로 보낸다.
if(isset($_SESSION['id']))
{
  echo "<script>alert('회원가입은 로그아웃 후 이용이 가능합니다.');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";
  exit;
}
//약관에 동의하지 않고 페이지로 넘어올 경우
if(!isset($_POST['all_agree']))
{
  echo "<script>alert('약관 동의 정보가 확인되지 않았습니다.');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";
  exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="viewport" content="width-device-width" initial-scale="1">
    <link rel="stylesheet" href="/happydog/css/happydog.css">
    <script>

    function idck(val)
    {
      var isdup = false;
      var t = "true";
      $.ajax({
        type:"POST",
        url:"idcheck.php",
        data:'id='+val,
        async:false,
        success: function(data){
          // $('#id_ck').html(d);
          if(data)
          {
            // $('#id_ck').html(d);
            isdup = true;
          }
          else
          {
            // $('#id_ck').html(d);
            isdup = false;
          }

        }
      });

      return isdup;
    }

    function emck(val)
    {
      var isdup = false;
      var t = "true";
      $.ajax({
        type:"POST",
        url:"emcheck.php",
        data:'email='+val,
        async:false,
        success: function(data){
          // $('#id_ck').html(d);
          if(data)
          {
            // $('#id_ck').html(d);
            isdup = true;
          }
          else
          {
            // $('#id_ck').html(d);
            isdup = false;
          }

        }
      });

      return isdup;
    }


    function idcheck(val)
    {
      var form = document.joinform;
      var idRule = /^\w{6,10}$/; // 영문 숫자 _ 조합 6~10글자
      //입력값이 없으면
      console.log(form.user_id.value);
      if(!val)
      {
        document.querySelector('.id_no_value').style.display='block';
        document.querySelector('.id_ck').style.display='none';
        return false;
      }
      //입력값은 있지만 정규식에 안맞는 경우
      else if(!idRule.test(val))
      {
        document.querySelector('.id_ck').style.display='block';
        document.querySelector('.id_no_value').style.display='none';
        return false;
      }
      else if(idck(val))
      {
        document.querySelector('.id_ck').style.display='block';
        document.querySelector('.id_no_value').style.display='none';
        return false;
      }
      else
      {
        document.querySelector('.id_no_value').style.display='none';
        document.querySelector('.id_ck').style.display='none';
        return true;
      }
    }


      function pwcheck()
      {
        var form = document.joinform;
        var pwRule = /^[A-Za-z\d$@$!%*#?&]{6,15}$/;//6-15자의 영문 대소문자, 숫자 및 특수문자 조합

        //입력값이 없으면
        console.log(form.user_pw.value);
        if(!form.user_pw.value)
        {
          document.querySelector('.pw_no_value').style.display='block';
          document.querySelector('.pw_ck').style.display='none';
          return false;
        }
        else if (!pwRule.test(form.user_pw.value))
        {
          document.querySelector('.pw_no_value').style.display='none';
          document.querySelector('.pw_ck').style.display='block';
          return false;
        }
        else
        {
          document.querySelector('.pw_no_value').style.display='none';
          document.querySelector('.pw_ck').style.display='none';
          return true;
        }

 // document.querySelector('.id_no_value').style.display='block';
 //      console.log(form.user_id.value);
      }

      function pwconcheck()
      {
        var form = document.joinform;
        //비밀번호와 비밀번호 확인이 맞지 않으면
        console.log(form.user_pw.value == form.pw_confirm.value);
        if(form.user_pw.value != form.pw_confirm.value)
        {
          document.querySelector('.pw_not_eqeual').style.display='block';

          return false;
        }
        else
        {
          document.querySelector('.pw_not_eqeual').style.display='none';
          document.querySelector('.pw_ck').style.display='none';
          return true;
        }
      }

      function nicknamecheck()
      {
        var form = document.joinform;
        //입력값이 없으면
        console.log(form.user_nickname.value);
        if(!form.user_nickname.value)
        {
          document.querySelector('.name_no_value').style.display='block';
          return false;
        }
        else
        {
              document.querySelector('.name_no_value').style.display='none';
              return true;
        }

      }

      function emailcheck(val)
      {
        var form = document.joinform;
        var emailRule = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;//이메일 정규식


        //입력값이 없으면
        console.log(form.user_email.value);
        if(!form.user_email.value)
        {
          document.querySelector('.email_no_value').style.display='block';
          document.querySelector('.email_incorrect').style.display='none';
          document.querySelector('.email_dup').style.display='none';
          return false;
        }
        //입력값은 있지만 이메일 정규식에 맞지 않는 경우
        else if (!emailRule.test(form.user_email.value))
        {
          document.querySelector('.email_incorrect').style.display='block';
          document.querySelector('.email_no_value').style.display='none';
          document.querySelector('.email_dup').style.display='none';

          return false;
        }
        else if(emck(val))
        {
            document.querySelector('.email_dup').style.display='block';
          document.querySelector('.email_incorrect').style.display='none';
          document.querySelector('.email_no_value').style.display='none';
          return false;
        }
        else
        {
            document.querySelector('.email_incorrect').style.display='none';
            document.querySelector('.email_no_value').style.display='none';
              document.querySelector('.email_dup').style.display='none';
            return true;
        }

      }

      function sign()
      {
        var form = document.joinform;

        var btn = document.getElementById("sign_btn");

        btn.disabled = true;

        //모든 입력항목을 검사한 후 모든 칸이 제대로 입력되었을 경우만 submit
        if(idcheck(form.user_id.value))
        {
          if( pwcheck(form.user_pw.value))
          {
            if( pwconcheck(form.pw_confirm.value))
            {
              if(nicknamecheck(form.user_nickname.value))
              {
                if(emailcheck(form.user_email.value))
                {
                    form.submit();
                }
                else {
                  form.user_email.focus();
                  btn.disabled = false;
                }
              }
              else {
                form.user_nickname.focus();
                btn.disabled = false;
              }
            }
            else {
              form.pw_confirm.focus();
              btn.disabled = false;
            }
          }
          else {
            form.user_pw.focus();
            btn.disabled = false;
          }
        }
        else {
          form.user_id.focus();
          btn.disabled = false;
        }
      }

      </script>





    <title>회원가입 - 해피도그</title>
  </head>
  <body>
    <header>
    <div class="logo" align="center">
      <h1>
        <a href="/happydog/index.php">해피도그</a>
      </h1>
    </div>
    </header>

<div align="center">
  <div class="loginbox" align="left">
    <form class="joinform" name="joinform" action="/happydog/join/join_confirm.php" method="post">
      <h2>회원가입</h2>
      <p>
        <input type="text" maxlength="10" name="user_id" id="user_id" placeholder="아이디   띄어쓰기 없이 영/숫자/_ 6-10자" class="edittext"
        onfocus="idcheck(this.value);" onblur="idcheck(this.value);">
      </p>
      <p class="id_no_value" style="color:red; display:none;">
         아이디를 입력해주세요.
      </p>
      <p class="id_ck" id="id_ck" style="color:red; display:none;">
         사용할 수 없는 아이디입니다.
      </p>
      <p>
        <input type="password" maxlength="15" name="user_pw" placeholder="비밀번호   6-15자의 영문 대소문자, 숫자 및 특수문자 조합" class="edittext"
        onfocus="pwcheck();" onblur="pwcheck();">
      </p>
      <p class="pw_no_value" style="color:red; display:none;">
         비밀번호를 입력해주세요.
      </p>
      <p class="pw_ck" style="color:red; display:none;">
         사용할 수 없는 비밀번호입니다.
      </p>
      <p>
        <input type="password" maxlength="15" name="pw_confirm" placeholder="비밀번호 확인" class="edittext"
        onfocus="pwconcheck();" onblur="pwconcheck();">
      </p>
      <p class="pw_not_eqeual" style="color:red; display:none;">
         비밀번호가 맞지 않습니다.
      </p>
      <p>
        <input type="text" maxlength="16" name="user_nickname" placeholder="이름" class="edittext"
          onfocus="nicknamecheck();" onblur="nicknamecheck();">
      </p>
      <p class="name_no_value" style="color:red; display:none;">
         이름을 설정해주세요.
      </p>
      <p>
        <input type="email" name="user_email" placeholder="이메일" class="edittext"
        onfocus="emailcheck(this.value);" onblur="emailcheck(this.value);" onkeydown="emailcheck();">
      </p>
      <p class="email_no_value" maxlength="20" style="color:red; display:none;">
         이메일을 입력해주세요.
      </p>
      <p class="email_incorrect" style="color:red; display:none;">
         입력한 이메일이 올바르지 않습니다.
      </p>
      <p class="email_dup" style="color:red; display:none;">
         사용할 수 없는 이메일입니다.
      </p>
      <hr>

      <p>
        <button id="sign_btn" class="btn" type="button" onclick="sign();">가입하기</button>
      </p>


    </form>
  </div>
</div>



  </body>
</html>
