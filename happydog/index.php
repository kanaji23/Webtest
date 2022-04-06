<?php   session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width" initial-scale="1">
    <title>해피도그</title>
    <link rel="stylesheet" href="/happydog/css/happydog.css?v=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="/happydog/js/happydog.js"></script>
  </head>
  <body>

    <!-- top_bar  시작-->
    <?php include 'top_bar.php'; ?>
    <!-- top_bar  끝-->

    <!-- header 시작  -->
    <?php include 'header.php'; ?>
    <!-- header 끝  -->

    <!-- menu bar 시작 -->
    <?php include 'menu_bar.php'; ?>
    <!-- menu bar 끝 -->



    <!-- slide 시작 -->
     <?php include 'slide.php';?>
    <!-- slide 끝 -->


    <!-- recentview 시작 -->
    <?php include 'recentview.php' ?>
    <!-- recentview 끝 -->


    <style media="screen">
      .new_goods {
        width:70%;
        height: 5%;
        border: 1px solid black;
        margin: 0 auto;
        overflow: hidden;
      }
    </style>
    <div class="new_goods">
      <h2>신상품</h2>
      <hr>
      <div class="goods_card">
        <img src="/happydog/ref/ad_1.jpg" width="200px" height="200px"><br>
        <a href="#">상품명</a>
        <p>별점</p>
        <a href="#">가격</a>
      </div>
      <div class="goods_card">
        <img src="/happydog/ref/ad_1.jpg" width="200px" height="200px"><br>
        <a href="#">상품명</a>
        <p>별점</p>
        <a href="#">가격</a>
      </div>
      <div class="goods_card">
        <img src="/happydog/ref/ad_1.jpg" width="200px" height="200px"><br>
        <a href="#">상품명</a>
        <p>별점</p>
        <a href="#">가격</a>
      </div>
      <div class="goods_card">
        <img src="/happydog/ref/ad_1.jpg" width="200px" height="200px"><br>
        <a href="#">상품명</a>
        <p>별점</p>
        <a href="#">가격</a>
      </div>
      <div class="goods_card">
        <img src="/happydog/ref/ad_1.jpg" width="200px" height="200px"><br>
        <a href="#">상품명</a>
        <p>별점</p>
        <a href="#">가격</a>
      </div>
      <div class="goods_card">
        <img src="/happydog/ref/ad_1.jpg" width="200px" height="200px"><br>
        <a href="#">상품명</a>
        <p>별점</p>
        <a href="#">가격</a>
      </div>
    </div>


    <!-- footer 시작 -->
      <?php include 'footer.php' ?>
    <!-- footer 끝 -->
  </body>
</html>
