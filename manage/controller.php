<?php
    require_once("lib/library.php");
    $errorvar = "";
    $success = "";
    $result = "";
    $updateresult = "";
    if($user->iflogin()){
        $page = $_REQUEST['page'];
        $controller_file = 'controllers/'.$page.'.php';
      if(isset($_REQUEST['page']) && is_file($controller_file)){
          require $controller_file;
          $r = "";
              
          /**
          * About Variable $errorvar & $success
          * these variables are used for passing messages from one page to another.
          * 
          * For AJAX request:
          *     it would just result in JSON - to be implemented
          * 
          * For Normal Request:
          *     it would redirect to index page with error msg / success msg
          * 
          */
          if(!isset($_REQUEST['ajaxrequest'])){
              if(isset($errorvar) && strlen($errorvar)){
                  $r = "&error=".urlencode($errorvar);
              }
              if(isset($success) && strlen($success)){
                  $r = "&success=".urlencode($success);
              }
              header('Location: index.php?id='.$page.$r.$success);
          }else{
              if($success == '' && $errorvar == '' && $result == ''){
                  $errorvar = 'No Action Available for your input.';
              }
              $a = array(
                    'success' => $success,
                    'error'   => $errorvar,
                    'result'  => $result /* $result would be an array of results */
              );
              
              echo json_encode($a, JSON_HEX_QUOT | JSON_HEX_TAG);
          }
          
      }else{
          echo 'No Action Available.';
      }
  }else{
      echo 'You need to login again.';
  }
?>
