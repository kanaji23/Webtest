<?php
session_start();
//로그인 상태면 경고문 띄우고 메인페이지로 보낸다.
if(isset($_SESSION['id']))
{
  echo "<script>alert('아이디 찾기는 로그아웃 후 이용이 가능합니다.');</script>";
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
        else
        {
            document.querySelector('.email_incorrect').style.display='none';
            document.querySelector('.email_no_value').style.display='none';
              document.querySelector('.email_dup').style.display='none';
            return true;
        }

      }

      function numcheck()
      {
        var form = document.joinform;
        var numRule = /^[0-9]{6}$/;
        //입력값이 없으면
        console.log(form.auth_num.value);
        if(!form.auth_num.value)
        {
          document.querySelector('.num_no_value').style.display='block';
          document.querySelector('.num_incorrect').style.display='none';
          return false;
        }
        else if(!numRule.test(form.auth_num.value))
        {
          document.querySelector('.num_no_value').style.display='none';
          document.querySelector('.num_incorrect').style.display='block';
          return false;
        }
        else
        {
          document.querySelector('.num_no_value').style.display='none';
          document.querySelector('.num_incorrect').style.display='none';
          return true;
        }
      }

      function sign()
      {
        var form = document.joinform;

        var btn = document.getElementById("sign_btn");

        btn.disabled = true;

        //모든 입력항목을 검사한 후 모든 칸이 제대로 입력되었을 경우만 submit

              if(nicknamecheck())
              {
                if(emailcheck(form.user_email.value))
                {
                  if(numcheck())
                  {
                    findid();
                    btn.disabled = false;
                  }
                  else
                  {
                    form.auth_num.focus();
                    btn.disabled = false;
                  }
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

        function send_auth()
        {
          var form = document.joinform;

          var btn = document.getElementById("auth_btn");
          btn.disabled = true;
          //모든 입력항목을 검사한 후 모든 칸이 제대로 입력되었을 경우만 submit

                if(nicknamecheck(form.user_nickname.value))
                {
                  if(emailcheck(form.user_email.value))
                  {

                    console.log('ajax 실행전');
                    send_mail();
                    console.log('ajax 실행후');

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

        function send_mail()
        {
          var form = document.joinform;
          var btn = document.getElementById("auth_btn");
          $.ajax({
            type:"POST",
            url:"findid_send.php",
            beforeSend: function(){btn.disabled = true;},
            data:'name='+form.user_nickname.value+'&email='+ form.user_email.value,
            async:true,
            success: function(data){
              // $('#id_ck').html(d);
              if(data)
              {
                //정상적으로 인증메일을 보냈을 때,
                alert('인증번호 발송 요청이 완료되었습니다.\n인증번호가 오지 않는 경우, 입력한 이름/이메일주소를 확인 후 다시 요청해주세요.');
                btn.disabled = false;
              }
              else
              {
                //정상적으로 못보냈을 때
                alert('인증번호 발송 요청이 완료되었습니다.\n인증번호가 오지 않는 경우, 입력한 이름/이메일주소를 확인 후 다시 요청해주세요.');
                btn.disabled = false;
              }

            }
          });
        }


        function findid()
        {
          var form = document.joinform;
          var btn = document.getElementById("sign_btn");
          $.ajax({
            type:"POST",
            url:"findid_check.php",
            beforeSend: function(){btn.disabled = true;},
            data:'name='+form.user_nickname.value+'&email='+ form.user_email.value + '&num=' + form.auth_num.value,
            async:true,
            success: function(data){
              // $('#id_ck').html(d);
              if(data)
              {
                //성공한 경우
                document.corr.chck.value = data;
                document.corr.submit();
                btn.disabled = false;
              }
              else
              {
                //실패한경우
                alert("입력한 정보가 정확하지 않거나 인증번호가 만료되었습니다.");
                btn.disabled = false;
              }

            }
          });
        }

      </script>





    <title>아이디 찾기 - 해피도그</title>
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
    <table border="1px solid black" style="width:100%">
      <tr>
        <th style="width:50%; border-top:15px solid rgb(113, 225, 255);"><h3>아이디 찾기</h3></th>
        <th style="width:50%; cursor:pointer;" onclick="location.href='/happydog/index.php'"><h3>비밀번호 재설정</h3></th>
      </tr>
    </table>

    <form class="joinform" name="joinform" action="/happydog/join/join_confirm.php" method="post">



      <p>
        <input type="text" maxlength="16" name="user_nickname" placeholder="이름" class="edittext"
          onfocus="nicknamecheck();" onblur="nicknamecheck();">
      </p>
      <p class="name_no_value" style="color:red; display:none;">
         이름을 입력해주세요.
      </p>
      <div>
        <input type="email" name="user_email" placeholder="이메일" class="edittext2"
        onfocus="emailcheck(this.value);" onblur="emailcheck(this.value);">
        <button type="button" id="auth_btn" class="btn30" onclick="send_auth();">인증번호 받기</button>
      </div>
      <p class="email_no_value" maxlength="20" style="color:red; display:none;">
         이메일을 입력해주세요.
      </p>
      <p class="email_incorrect" style="color:red; display:none;">
         입력한 이메일이 올바르지 않습니다.
      </p>
      <p class="email_dup" style="color:red; display:none;">
         사용할 수 없는 이메일입니다.
      </p>

      <p>
        <input type="text" maxlength="16" name="auth_num" placeholder="인증번호 6자리를 입력해주세요" class="edittext"
          onfocus="numcheck();" onblur="numcheck();">
      </p>
      <p class="num_no_value" style="color:red; display:none;">
         인증번호를 입력해주세요.
      </p>
      <p class="num_incorrect" style="color:red; display:none;">
         입력한 인증번호가 올바르지 않습니다.
      </p>
      <hr>

      <p>
        <button id="sign_btn" class="btn" type="button" onclick="sign();">아이디 찾기</button>
      </p>


    </form>

    <form name="corr" action="foundid.php" method="post">
      <input type="hidden" name="chck" value="zz">
    </form>
  </div>
</div>



  </body>
</html>
