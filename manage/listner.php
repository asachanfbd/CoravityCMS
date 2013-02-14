<?php
    require_once("lib/library.php");
    if($user->iflogin()){
        $listner_file = 'listners/'.$_GET['page'].'.php';
      if(isset($_GET['page']) && is_file($listner_file)){
          require_once $listner_file;
      }else{
          echo 'No Action Available.';
      }
  }else{
      echo 'You need to login again.
      <script>window.location.reload();</script>
      ';
  }
?>
