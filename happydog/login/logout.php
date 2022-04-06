<?php
session_start();
$res=session_destroy();
if($res)
{
  setcookie("user_id_cookie", $id, time() - (86400 * 30), "/" );
  setcookie("user_hash_cookie", $hash, time() - (86400 * 30), "/" );
  header('Location: /happydog/index.php');
}


?>
