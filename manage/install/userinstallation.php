<?php
  $conf=getdbconfig();

  $host=$conf['hostname']; /*host name*/
  $uname=$conf['username']; /*user name*/
  $pass=$conf['password']; /*password*/
  $dbname=$conf['database']; /*database name*/  

  
 
  $db=new db($dbname, $host, $uname, $pass);/*initialization in case of server is not on localhost*/


  $user_tables=array('users_email', 'users_info', 'users_notifications', 'users_sessions', 'users_logininfo',  'users_privilege');
  
  for($i=0; $i<5; $i++){
        if($db->checktable($user_tables[$i])){
                insert($user_tables[$i]);
        }
  }
  
  for($i=0; $i<5; $i++){
      alter($user_tables[$i]);
  }
  
  
function insert($tablename){
     global $db;
     if($tablename=='users_email'){
         $db->replace($tablename, array('id'=>'superadmin', 'email'=>$_REQUEST['email']));
     }if($tablename=='users_logininfo'){
         $db->replace($tablename, array('id'=>'superadmin', 'password'=>md5($_REQUEST['password'])));
     }elseif($tablename=='users_info'){
         $db->replace($tablename, array('id'=>'superadmin', 'fname'=>$_REQUEST['fname'], 'lname'=>$_REQUEST['lname'], 'mobile'=>$_REQUEST['mobile']));
     }elseif($tablename=='users_privilege'){
         $db->replace($tablename, array('id'=>'superadmin', 'privileges'=>'superadmin'));
     }else{
         return false;
     }
  }
  function alter($tablename){
     global $db;
     if($tablename=='users_email'){
         $db->querydb("ALTER TABLE `users_email` ADD CONSTRAINT `users_email_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users_logininfo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
     }elseif($tablename=='users_info'){
         $db->querydb("ALTER TABLE `users_info` ADD CONSTRAINT `users_info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users_logininfo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
     }elseif($tablename=='users_notifications'){
         $db->querydb("ALTER TABLE `users_notifications` ADD CONSTRAINT `users_notifications_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users_logininfo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
     }elseif($tablename=='users_sessions'){
         $db->querydb("ALTER TABLE `users_sessions` ADD CONSTRAINT `users_sessions_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users_logininfo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
     }else{
         return false;
     }   
  }
  
?>