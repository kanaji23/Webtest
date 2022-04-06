<?php
  $conn = mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");
  //cat1 긁어오는 쿼리
  $sql = "SELECT * FROM cat1";
  $result = mysqli_query($conn, $sql);

 ?>

<nav class="main_nav">
    <ul class="main_menu2">
      <li id="main_li" class="main_li">
        <span>상품 카테고리</span>
        <div class="sub_drop">

        <ul class="sub_menu2">
            <?php
            while($row = mysqli_fetch_array($result))
              {
                echo '<li class="sub_li"><a href="#">'.$row["name"].'
                </a><div class="ssub_drop"><ul class="ssub_menu2">';
                $sql2 = "SELECT * FROM cat2 WHERE cat1 = '{$row['id']}'";
                $result2 = mysqli_query($conn, $sql2);
                while($row2 = mysqli_fetch_array($result2))
                {
                  echo '<li><a href="/happydog/shop/productlist.php?cate='.$row2['id'].'">'.$row2['name'].'</a></li>';
                }
                echo '</ul></div></li>';
              }
             ?>
        </ul>
      </div>
      </li>
      <li class="main_li">이벤트</li>
      <li class="main_li">공지사항</li>
    </ul>
</nav>
