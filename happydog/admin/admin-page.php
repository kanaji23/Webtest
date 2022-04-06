<?php
session_start();
if(!isset($_SESSION['id']) || $_SESSION['isadmin'] == 0)
{
  echo "<script>alert('잘못된 접근입니다.');</script>";
  echo "<script>window.location='http://localhost/happydog/index.php';</script>";
}
$conn = mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>관리자 페이지 - 해피도그</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/happydog/css/happydog.css?ver=1"/>
    <style>

    ul#navi {
        width: 200px;
}
    ul#navi, ul#navi ul {
        margin:0;
        padding:0;
        list-style:none;
}
    li.group {
        margin-bottom: 3px;
}
    li.group div.title {
        height: 35px;
        line-height: 35px;
        background:#9ab92e;
        cursor:pointer;
}
    ul.sub li {
        margin-bottom: 2px;
        height:35px;
        line-height:35px;
        background:#f4f4f4;
        cursor:pointer;
}
    ul.sub li a {
        display: block;
        width: 100%;
        height:100%;
        text-decoration:none;
        color:#000;
}
    ul.sub li:hover {
        background:#cf0;
}
div.title a {
    display: block;
    width: 100%;
    height:100%;
    text-decoration:none;
    color:#000;
}

</style>


  </head>
  <body>
    <?php include '../top_bar.php'; ?>
    <?php include '../header.php'; ?>
    <?php include '../menu_bar.php'; ?>

  <main  style="margin: 5% 10% 0% 10%; font-size: 20px;">
    <h1>관리 페이지</h1><hr>

    <div style="float:left">
      <ul id="navi">
            <li class="group">
                <div class="title"> <a href="?board=1">회원 관리</a> </div>
            </li>
            <li class="group">
                <div class="title"><a href="?board=3">카테고리 관리</a></div>
            </li>
            <li class="group">
                <div class="title"><a href="?board=2">상품 관리</a></div>
            </li>
            <li class="group">
                <div class="title">고객의 소리</div>
                <ul class="sub">
                    <li><a href="#">문의</a></li>
                    <li><a href="#">후기</a></li>
                </ul>
            </li>
        </ul>
    </div>


      <div style="float:left; margin:30px;">
        <?
        if(isset($_GET['board']))
        {
          include ("admin/{$_GET['board']}.php");
        }
        else {
          echo "<h2>관리자 페이지</h2>";
          echo "<p>좌측 메뉴에서 관리하고 싶은 항목을 선택하세요.</p>";
        }
         ?>
      </div>
  </main>

  </body>
</html>
