<?php
      $re = $db->querydb("SELECT * FROM errorlog ORDER BY added DESC LIMIT 0, 50");
      $each = '';
      while($ro = $re->fetch_object()){
          $each .= $view->getcmsrow('error_explorer', $ro->ERRORID, $ro->ERRORMSG, 'on line <strong>'.$ro->ERRORLINE.'</strong> in page <strong>'.$ro->ERRORFILE.'</strong> '.getRelativeTime($ro->added), 'Open');
      }
      $body .= $view->getcmsbox('','Errors occured into the system', $each);
    ?>
