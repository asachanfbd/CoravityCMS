<?php
  class enquiry{
      
      function getall(){
          global $db;
          $re = $db->querydb("SELECT * FROM enquiries ORDER BY readstatus, modified DESC LIMIT 0,30");
          if($re->num_rows){
              $arr = array();
              while($ro = $re->fetch_object()){
                  $arr[] = $ro;
              }
              return $arr;
          }else{
              return false;
          }
      }
      
      function getread(){
          global $db;
          $re = $db->querydb("SELECT * FROM enquiries WHERE readstatus = '2' ORDER BY modified DESC LIMIT 0,30");
          if($re->num_rows){
              $arr = array();
              while($ro = $re->fetch_object()){
                  $arr[] = $ro;
              }
              return $arr;
          }else{
              return false;
          }
      }
      
      function getunread(){
          global $db;
          $re = $db->querydb("SELECT * FROM enquiries WHERE readstatus = '1' ORDER BY modified DESC LIMIT 0,30");
          if($re->num_rows){
              $arr = array();
              while($ro = $re->fetch_object()){
                  $arr[] = $ro;
              }
              return $arr;
          }else{
              return false;
          }
      }
      
      function getenquiry($id){
          global $db;
          $this->markasread($id);
          return $db->querydb("SELECT * FROM enquiries WHERE id = '".$id."'", true);
      }
      
      function markasread($id){
          global $db;
          $values = array('readstatus' => '2');
          $db->update('enquiries', $values, "id = '".$id."'");
          return true;
      }
      
      function getbyrange($start, $end){
          global $db;
          $re = $db->querydb("SELECT * FROM enquiries WHERE added > '".$start."' && added < '".$end."' ORDER BY modified DESC LIMIT 0,30");
          if($re->num_rows){
              $arr = array();
              while($ro = $re->fetch_object()){
                  $arr[] = $ro;
              }
              return $arr;
          }else{
              return false;
          }
      }
      
      public function add($name, $email, $phone, $service, $msg, $services){
          $values = array(
                        'id'        =>       uniqid(),
                        'name'      =>       $name,
                        'email'     =>       $email,
                        'phone'     =>       $phone,
                        'address'   =>       $service,
                        'selcetservices'=>   $services,
                        'message'   =>       $msg
          );
          global $db;
          
         /* $body  = "Name: ".$name."\r\n";
          $body .= "Address: ".$service."\r\n";
          $body .= "Phone: ".$phone."\r\n";
          $body .= "Email: ".$email."\r\n";
          $body .= "Message: ".$msg."\r\n";
          $headers = 'From: noreply@universalprideinteriors.com'."\r\n";
         // $headers .= 'Cc: sales@universalprideinteriors.com'."\r\n";
          mail('manish12jes@gmail.com', 'New Query on universalprideinteriors.com', $body, $headers);
         */
          
          return $db->insert('enquiries', $values);
          
      }
      
  }
?>
