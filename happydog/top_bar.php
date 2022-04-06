<script>
  function move_cart_cookie()
  {
    $.ajax({
      type:"POST",
      url:"move_cart_cookie.php",
      async:false,
      success: function(data){
        // $('#id_ck').html(d);
        if(data)
        {
          if(confirm('상품이 장바구니에 담겼습니다. \n장바구니로 이동하시겠습니까?'))
          {
            location.href = '/happydog/cart.php';
          }
          else
          {
            location.reload();
          }

        }
        else {
          alert('이동 실패!');
        }

      }
    });
  }

  function del_cart_cookie()
  {
    $.ajax({
      type:"POST",
      url:"del_cart_cookie.php",
      async:false,
      success: function(data){
        // $('#id_ck').html(d);
        if(data)
        {
          location.reload();
        }
        else {
          alert('쿠키 삭제 실패!');
        }

      }
    });
  }

</script>

  <div class="top_bar">
    <nav class="top_nav">

      <?php

      if(isset($_COOKIE['user_id_cookie']) && isset($_COOKIE['user_hash_cookie'] ))
      {
        $user = $_COOKIE['user_id_cookie'];
        $master_key = "kadfadi";
        $conn = mysqli_connect("localhost", "root", "qlqjsqlqjs", "happydog");
        $query = "SELECT * FROM user WHERE id ='{$user}'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $pass = $row['pw'];
        $hash = md5($master_key.$pass);
        if($_COOKIE['user_hash_cookie'] == $hash)
        {
          $_SESSION['id'] = $_COOKIE['user_id_cookie'];
          $_SESSION['idno'] = $row['idno'];
          $_SESSION['isadmin'] = $row['isadmin'];
          $_SESSION['nickname'] = $row['name'];
          $_SESSION['email'] = $row['email'];
        }
      }

      // 아이디로 로그인이 되면 환영 문구가 뜬다
      if(isset($_SESSION['id']) && $_SESSION['isadmin'] == 0)
      {
        echo  '<span class="top_greet">안녕하세요 '. $_SESSION['nickname']. '님!</span>';
      }
      else if(isset($_SESSION['id']) && $_SESSION['isadmin'] >= 1)
      {
        echo  '<span class="top_greet">[관리자 모드] 안녕하세요 '. $_SESSION['nickname']. '님!</span>';
      }
       ?>

    <ul class="top_ul">
      <li class="top_li">
        <?php
        // 아이디로 로그인이 되면 로그아웃 버튼이 생긴다
        if(isset($_SESSION['id']))
        {
          echo  '<a class="nav-link" href="/happydog/login/logout.php">로그아웃</a>';
        }
        else
        {
          echo '<a class="nav-link" href="/happydog/login/login.php">로그인</a>';
        }

        ?>
        <span> |&nbsp;</span>
      </li>

      <li class="top_li">
        <?php
        // 아이디로 로그인이 되면 마이페이지 버튼이 생긴다
        if(isset($_SESSION['id'])&& $_SESSION['isadmin'] == 0)
        {
          echo  '<a class="nav-link" href="#">마이페이지</a>';
        }
        else if(isset($_SESSION['id']) && $_SESSION['isadmin'] >= 1)
        {
          echo  '<a class="nav-link" href="/happydog/admin/admin-page.php">관리 페이지</a>';
        }
        else
        {
          echo ' <a class="nav-link" href="/happydog/join/agreement.php">회원가입</a>';
        }
        ?>
        <span> |&nbsp;</span>
      </li>






      <li class="top_li">
        <a class="nav-link" href="/happydog/cart.php">장바구니</a>
        <span> |&nbsp;</span>
      </li>

      <li class="top_li">
        <a class="nav-link" href="#">고객센터</a>
      </li>
    </ul>
  </span>
  </nav>
</div>

<?php
  if(isset($_SESSION['id']) && isset($_COOKIE['cart']))
  {
    echo "<script>
    if(confirm('비로그인 상태에서 담은 장바구니 목록을 옮기시겠습니까?'))
    {
      move_cart_cookie();
    }
    else
    {
      del_cart_cookie();
    }
    </script>";
  }
 ?>
