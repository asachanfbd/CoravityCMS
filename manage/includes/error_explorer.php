<?php
      if($db->checktable('errorlog')){
          if(isset($_REQUEST['empty'])){
             $db->querydb("DELETE FROM errorlog"); 
          }
          
          if(isset($_REQUEST['delete'])){
             $db->querydb("DELETE FROM errorlog WHERE error_id='".$_REQUEST['delete']."'");  
          }
          
          if(isset($_REQUEST['open'])){
              $add='';
              $re = $db->querydb("SELECT * FROM errorlog WHERE error_id='".$_REQUEST['open']."'", true);
              if($re){
                  $d='<table style="border: 1px dotted #aaa; max-width:500px; border-radius: 0.5px; color: #000">';
                  $d.='<tr><td>ID</td><td> : </td><td>'.$re->error_id.'</td></tr>';
                  $d.='<tr><td>File</td><td> : </td><td>'.$re->error_file.'</td></tr>';
                  $d.='<tr><td>Line</td><td> : </td><td>'.$re->error_line.'</td></tr>';
                  $d.='<tr><td>Message</td><td> : </td><td>'.$re->error_msg.'</td></tr>';
                  $d.='<tr><td>Time</td><td> : </td><td>'.getRelativeTime($re->added).'</td></tr>';
                  $d.='<tr><td>Vars</td><td> : </td><td><pre>'.$re->error_vars.'</pre></td></tr>';
                  $d.='<table>';
                   $add=array('Go Back'=>'?page=homepage&type=subnav&subpage=error_explorer', 'Delete'=>'?page=homepage&type=subnav&subpage=error_explorer&delete='.$re->error_id); 
              }else{
                  $add=array('Go Back'=>'?page=homepage&type=subnav&subpage=error_explorer');
              }
              $body.=$view->getcmsbox('','Error Explorer', $d, '', $add); 
          }else{
              $add='';
              $re = $db->querydb("SELECT * FROM errorlog ORDER BY added DESC");
              $trow[]=array('Error No.', 'Message', 'Line No.', 'File', 'Time', 'Action');
              if($re->num_rows>0){
                  $i=1;
                  while($ro = $re->fetch_object()){
                      $delete='<a href="?page=homepage&type=subnav&subpage=error_explorer&delete='.$ro->error_id.'" title="return confirm(\'You are about to delete this error log!\')">Delete</a>';
                      $open='<a href="?page=homepage&type=subnav&subpage=error_explorer&open='.$ro->error_id.'">Open</a>';
                      $trow[]=array($i, $ro->error_msg, $ro->error_line, $ro->error_file, getRelativeTime($ro->added), $open.'  '.$delete);
                      $i++;
                  }
                  $add=array('Empty Errorlog'=>'?page=homepage&type=subnav&subpage=error_explorer&empty'); 
              }       
              $body .= $view->getcmsbox('','Error Explorer', $view->createdatatable($trow), '', $add);   
          }
      }
?>