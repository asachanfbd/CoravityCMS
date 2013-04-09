<?php

  if($_REQUEST['type'] == 'adduser'){
      if($_REQUEST['email'] != '' && validatemail($_REQUEST['email'])){
          $q = "SELECT * FROM users_email WHERE email = '".$_REQUEST['email']."'";
          if($db->querydb($q, true)){
              $errorvar = "Email already exists.";
          }
          else{
            
            if(isset($_REQUEST['addedituser'])){
                  $permission_addedituser =$_REQUEST['addedituser'];  
            }else{
                  $permission_addedituser ='na';
            }
            if(isset($_REQUEST['viewerror'])){
                  $permission_viewerror   =$_REQUEST['viewerror']; 
            }else{
                  $permission_viewerror='na';
            }
            if(isset($_REQUEST['editpage'])){
                  $permission_editpage    =$_REQUEST['editpage'];
            }else{
                  $permission_editpage='na';
            }
            if(isset($_REQUEST['delenq'])){
                  $permission_delenq      =$_REQUEST['delenq'];
            }else{
                  $permission_delenq='na';
            }  
            if(isset($_REQUEST['addpage'])){  
                $permission_addpage     =$_REQUEST['addpage'];
            }else{
                $permission_addpage='';
            }
            if(isset($_REQUEST['seestats'])){
                $permission_seestats    =$_REQUEST['seestats'];
            }else{
                $permission_seestats='na';
            }
            if(isset($_REQUEST['chsiteconfig'])){
                $permission_chsiteconfig=$_REQUEST['chsiteconfig'];
            }else{
                $permission_chsiteconfig='na';
            }
    
             $valar=array(
                    'addedituser'         => $permission_addedituser,
                    'editpage'            => $permission_editpage,
                    'viewerror'           => $permission_viewerror,
                    'delenq'              => $permission_delenq,
                    'seestats'            => $permission_seestats,
                    'chsiteconfig'        => $permission_chsiteconfig,
                    'addpage'             => $permission_addpage
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
        
            if($_POST['npass'] == $_POST['cpass']){
                $q="UPDATE users_logininfo SET password='".md5($_POST['npass'])."' where id='".$id."'";
                if($db->querydb($q)){
                $success = "completed";
                $result = 'Password Updated Successfully ';
            }
            }else{
                $errorvar = "Password confirmation failed.";
            }
       
        }
        }
    }
?>
