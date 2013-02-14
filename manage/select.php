<?php
     require_once('lib/library.php');
     $tbl_name = 'bt_sms_formats';
     if(isset($_REQUEST['name']) && $_REQUEST['name'] != ''){
         $value['id'] = uniqid();
         $value['name']=$_REQUEST['name'];
         $value['format']=$_REQUEST['format'];
         $db->insert($tbl_name, $value);
         echo "<div>Format Inserted</div>";
     }
     
     if(isset($_REQUEST['smsformat']) && $_REQUEST['smsformat'] != ''){
         $q = "SELECT * FROM ".$tbl_name." WHERE name = '".$_REQUEST['smsformat']."'";
         $re = $db->querydb($q, true);
         if($re){
             $format = $re->format;
             $i = 2;
             while(isset($_REQUEST['A'.$i])){
                 $format = str_replace('#A'.$i.'#', $_REQUEST['A'.$i], $format);
                 $i++;
             }
             $senderid = 'SCHOOL';
             $message = urlencode($format); //enter Your Message
             $mobile = '9971118446';
             $url = "http://www.nimbusit.in/binapi/pushsms.php?usr=671427&pwd=9999306441&sndr=".$senderid."&ph=".$mobile."&rpt=1&text=".$message;
             echo file_get_contents($url);
         }
     }
     
     $d = $view->getformfields('Enter Name', 'text', 'name', 'Enter the name of format');
     $d.= $view->getformfields('SMS Format', 'textarea', 'format', 'Enter the template');
     $d.= $view->getformfields('', 'submit', 'submitformat', '', 'Submit');
     //echo '<form>'.$d.'</form>';
     
     $format_name = 'login';
     
     $q = "SELECT * FROM ".$tbl_name." WHERE name = '".$format_name."'";
     $re = $db->querydb($q, true);
     if($re){
         $format = $re->format;
         for($i = 0; $i<10; $i++){
             $txt = '<input type="text" name="A'.$i.'">';
             $format = str_replace('#A'.$i.'#', $txt, $format);
         }
         $format .= '
         <input type="hidden" name="smsformat" value="'.$format_name.'">
         <input type="submit">';
         //echo '<form>'.$format.'</form>';
     }
     
     
 ?>