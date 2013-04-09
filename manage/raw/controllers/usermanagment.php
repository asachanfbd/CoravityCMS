<?php

  if($_REQUEST['type'] == 'adduser'){
      if($_REQUEST['email'] != '' && !validatemail($_REQUEST['email'])){
          $q = "SELECT * FROM users_email WHERE email = '".$_REQUEST['email']."'";
          if($db->querydb($q, true)){
              $errorvar = "Email already exists.";
          }
          else{
             $valar=array(
                    'addedituser'         => $_REQUEST['addedituser'],
                    'editpage'            => $_REQUEST['editpage'],
                    'viewerror'           => $_REQUEST['viewerror'],
                    'delenq'              => $_REQUEST['delenq'],
                    'seestats'            => $_REQUEST['seestats'],
                    'chsiteconfig'        => $_REQUEST['chsiteconfig'],
                    'addpage'              => $_REQUEST['addpage']
                    );
            if($user->setuser($_REQUEST['fname'], $_REQUEST['lname'], $_REQUEST['email'],$valar)){  
                
                $updateresult = "User added successfully. A mail has been sent to the user with login details.";
                $result = $updateresult;
                $success='completed';
            }else{
                $errorvar = "Problem creating user";
            }  
          }
      }else{
          $errorvar = "A valid Email is required.";
      }
    }
    
    
  if($_REQUEST['type'] == 'saveuser'){
      //  $id=$user->getid();
      $id=$_REQUEST['userid'];
        if(isset($_REQUEST['password'])){
            $q="UPDATE `users_email` as `ue` , `users_info` as `ui` SET ue.email='".$_REQUEST['email']."',ui.fname='".$_REQUEST['fname']."', ui.lname='".$_REQUEST['lname']."' where ue.id=ui.id && ui.id='".$id."'";
            $db->querydb($q);
            
        }else{
            $q="UPDATE `users_email` as `ue` , `users_info` as `ui` SET ue.email='".$_REQUEST['email']."',ui.fname='".$_REQUEST['fname']."', ui.lname='".$_REQUEST['lname']."' where ue.id=ui.id && ui.id='".$id."'";
             if($db->querydb($q)){
                $updateresult = "User updated successfully.";
                $result = $updateresult;
                $success='updatedontreset';
             }
             else{
                 $errorvar='Query failed.';
             }
        }
    }
    
  if($_REQUEST['type'] == 'changepassword'){
            $id=$_REQUEST['userid'];
          $q="SELECT * from users_logininfo where id='".$id."'";
          $ro=$db->querydb($q);
          if($ro->num_rows){
              while($r=$ro->fetch_object()){
        if(md5($_POST['pas']) == $r->password){
            if($_POST['npass'] == $_POST['cpass']){
                $q="UPDATE users_logininfo SET password='".md5($_POST['npass'])."' where id='".$id."'";
                if($db->querydb($q)){
                $success = "completed";
                $result = 'Password Updated Successfully ';
            }
            }else{
                $errorvar = "Confirmed password must match to new password.";
            }
        }else{
            $errorvar = "Current password didn't match.";
        }
        }
        }
    }
?>
