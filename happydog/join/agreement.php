<?php
session_start();
//로그인 상태면 경고문 띄우고 메인페이지로 보낸다.
if(isset($_SESSION['id']))
{
  echo "<script>alert('회원가입은 로그아웃 후 이용이 가능합니다.');</script>";
  echo "<script>window.location='/happydog/index.php';</script>";
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="/happydog/css/happydog.css">

    <script>

    function all_check()
    {
      if(agree_form.all_agree.checked == true)
      {
            //올체크가 체크되어있으면 전체 다 체크
           for(i=0; i < agree_form.agree.length; i++)
           {
               agree_form.agree[i].checked = true;
           }
       }
       else
       {

         for(i=0; i < agree_form.agree.length; i++)
         {
             agree_form.agree[i].checked = false;
         }
       }
   }

   function isall()
    {
      for(var i=0; i < 3; i++ )
      {
         if(agree_form.agree[i].checked != true )
         {
            agree_form.all_agree.checked = false;
  	        return false;
         }
      }

      agree_form.all_agree.checked = true;
      return true;
    }

    function agree_submit()
    {
      //모두 체크되어 있지 않으면
      if(!isall())
      {
        alert('해피도그 회원가입을 위해 필수 동의항목 모두 동의해주시기 바랍니다.');
      }
      else
      {
        agree_form.submit();
      }

    }


    </script>
  </head>
  <body>
    <header>
      <div class="logo" align="center">
        <h1>
          <a href="/happydog/index.php">해피도그</a>
        </h1>
      </div>

      <style media="screen">
        .agreebox {
          width:70%;
          margin: 0 auto;

        }

        .terms {
          width:90%;
          margin: 0 auto;
          text-align: left;
          border: 1px solid black;
        }
      </style>
      <div class="agreebox">
        <h2>약관 동의</h2>
        <hr>
        <form class="agree_form" id="agree_form" name="agree_form" action="join.php" method="post">
          <label>
            <input type="checkbox" name="all_agree" value="agree" onclick="all_check();" required>
            전체 동의
          </label>
          <hr>
          <label>
            <input type="checkbox" name="agree" onclick="isall();" required>
            (필수) 해피도그 구매회원 이용 약관
          </label><a href="#term1">내용 보기</a><br>
          <label>
            <input type="checkbox" name="agree" onclick="isall();" required>
            (필수) 전자 금융 서비스 이용 약관
          </label><a href="#term2">내용 보기</a><br>
          <label>
            <input type="checkbox" name="agree" onclick="isall();" required>
            (필수) 개인 정보 수집 및 이용
          </label><a href="#term3">내용 보기</a><br><br>

          <input class="btn" type="button" onclick="agree_submit()" value="동의하고 회원가입">
        </form>
        <br>
        <br>

        <div class="terms">

          <h2>[약관 중요 사항 고지]</h2>
          <h3 id="term1">(필수) 해피도그 회원 이용약관</h3>
          <p>
            1. 회원의 주소 또는 e-mail주소에 도달함으로써 회사의 통지는 유효하고, 회원 정보의 변경/미 변경에 대한 책임은 회원에게 있음. (제8조)<br>
            2. 약관이 정하는 부정거래 행위를 한 회원에 대하여 제재 조치 가능 예: 직거래, 경매 부정행위, 시스템 부정행위, 결제 부정행위, 재판매 목적의 거래행위 등. (제36조)<br>
          </p>

          <h3 id="term2">(필수) 전자금융 서비스 이용약관</h3>
          <p>
            1. 접근매체의 양도?양수, 대여?사용위임, 질권설정 기타 담보 제공 및 이의 알선과 접근매체를 제3자에게 누설?노출,방치하는 것은 금지됨. (제17조, 제21조, 제23조)<br>
            2. 소비자가 재화 등을 공급받은 날부터 3 영업일이 지나도록 정당한 사유의 제시 없이 그 공급받은 사실을 통보하지 않는 경우 소비자의 동의 없이 판매자에게 결제대금을 지급할 수 있으며, 회사가 결제대금을 지급하기 전에 소비자가 그 결제대금을 환급 받을 사유가 발생한 경우 이를 소비자에게 환급함. (제19조)<br>
            3. 이용자의 선불전자지급수단 잔액이 구매 취소 등의 사유 발생으로 회사가 이용자로부터 환수해야 하는 환수 대상액보다 작을 경우 회사는 당해 이용자의 선불전자지급수단을 마이너스로 처리할 수 있음. (제27조)<br>
          </p>

          <h3 id="term3">(필수) 개인정보 수집 및 이용</h3>
          <p>
            <table border="1px solid black" style="text-align:center;">
               <tr style="background:rgb(205, 205, 205)">
                 <td>목적</td>
                 <td>항목</td>
                 <td>보유기간</td>
               </tr>
               <tr>
                 <td>본인여부 확인, 계약이행 및 약관변경 등의 고지를 위한 연락, 본인의사확인 및 민원 등의 고객불만 처리, 서비스 제공</td>
                 <td>성명, 아이디, 비밀번호, 휴대폰 번호, 이메일주소</td>
                 <td><b>회원탈퇴 후 5일 이내 또는 법령에 따른 보존기간</b></td>
               </tr>
            </table>
          </p>
        </div>

      </div>
    </header>
  </body>
</html>
