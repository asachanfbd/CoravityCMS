<?php 
global $user;
    if(isset($_REQUEST['adduser'])){
         if($user->haspermission('addedituser',$user->getid())){ 
    $data1='<form action="controller.php" method="post" class="ajaxsubmitform">
        <input type="hidden" value="" name="ajaxrequest" id="ajaxrequest">
        <input type="hidden" value="'.$_REQUEST['subpage'].'" name="page" id="page">
        <input type="hidden" value="adduser" name="type" id="type">
        <div id="adduserdiv">
        <table width=100%>
            <tr class="addusertr">
                <td><input type="text" placeholder="First Name" name="fname" id="fname"></td>
            </tr>
            <tr class="addusertr">
                <td><input type="text" placeholder="Last Name" name="lname" id="lname"></td>
            </tr>
            <tr class="addusertr">
                <td><input type="text" placeholder="E-Mail address" name="email" id="email"></td>
            </tr>
          
             <tr>
                <td> Select the Permission for the Users</td>
            </tr>
            <tr>
                <td><input type="checkbox" value="addedituser" name="addedituser">Can Add/Edit User</td>
            </tr>
            <tr>
                <td><input type="checkbox" value="addeditpage" name="addpage">Can Add/Edit Page</td>
            </tr>
            <tr>
                <td><input type="checkbox" value="viewerror" name="viewerror">Can View Error Explorer</td>
            </tr>
            <tr>
                <td><input type="checkbox" value="delenq" name="delenq">Can View/Delete Enquries</td>
            </tr>
            <tr>
                <td><input type="checkbox" value="seestats" name="seestats">Can See site stats</td>
            </tr>
             <tr>
                <td><input type="checkbox" value="chsiteconfig" name="chsiteconfig">Can Change Site configuration</td>
            </tr>
             <tr>
                <td><input class="button" type="submit" value="Add" name="addnewuser" id="addnewuser"></td>
            </tr>
        </table>
        </div>
       
    </form>';
    $body .= $view->getcmsbox('','User Management',"<div style='font-size:20px; color:#4D90FE '>Add User Details</div>".$data1,'Add User ',array("List User"=>"?subpage=".$_GET['subpage']));
    }
    else{
        $data1='You are not authorized to Add a new user.';
        $body .= $view->getcmsbox('','User Management',$data1,'Add User ',array("List User"=>"?subpage=".$_GET['subpage']));
    }
    
   }
    
         elseif(isset($_REQUEST['deleteuser'])){
        global $user;
        $stat_res ='';
        global $db;
        if($user->deluser($_REQUEST['deleteuser'])){
             $stat_res = $view->highlightsuccess('User Deleted Successfully');
        }
         $body .= $view->getcmsbox('','User Management', "<div class='tasklist'>".$stat_res.getuserlist()."</div>", 'View pages of website',array('Add New User'=>"?subpage=".$_GET['subpage']."&adduser")); 
        
    }
    
         elseif(isset($_REQUEST['editprofile'])){
       $id=$_REQUEST['editprofile'];
         $q="SELECT ue.email, ui.fname, ui.lname from `users_email` as `ue` , `users_info` as `ui` where ue.id=ui.id && ui.id='".$id."'";
         $ro=$db->querydb($q);
         if($ro->num_rows){
             while($r=$ro->fetch_object()){
                 $data1='
                <form action="controller.php" method="post" class="ajaxsubmitform">
                <input type="hidden" value="" name="ajaxrequest" id="ajaxrequest">
                <input type="hidden" value="'.$_REQUEST['subpage'].'" name="page" id="page">
                <input type="hidden" value="saveuser" name="type" id="type">
                <input type="hidden" value="'.$id.'" name="userid">
                <div id="adduserdiv">
                <div style="font-size:16px;color:#0059B2">Edit User Detals.</div>
                <table width=100%>
                    <tr class="addusertr">
                <td><input type="text"  name="fname" value="'.$r->fname.'" id="fname"></td>
                </tr>
                <tr class="addusertr">
                    <td><input type="text"  name="lname" value="'.$r->lname.'"id="lname"></td>
                </tr>
                <tr class="addusertr">
                    <td><input type="text" value="'.$r->email.'" name="email" id="email"></td>
                </tr>
                <tr>
                <tr>
                <td><input class="button" type="submit" value="save" name="saveuser" id="saveuser">
                        </tr>
                    </table>
                    </div>
                </form>';
                         }
                          $body .= $view->getcmsbox('','Edit Profile', $data1, 'Click on the above settings to edit.',array('List User'=>"?subpage=".$_GET['subpage']));
                    }
                    
         }
         
         elseif(isset($_REQUEST['changepassword'])){
             global $db;
             $id=$_REQUEST['changepassword'];
             $q="SELECT * from users_logininfo where id='".$id."'";
             $ro=$db->querydb($q);
             if($ro->num_rows){
                 while($ro->fetch_object()){
                     $data1='<form action="controller.php" method="post" class="ajaxsubmitform">
                     <input type="hidden" value="" name="ajaxrequest" id="ajaxrequest">
                     <input type="hidden" value="'.$_REQUEST['subpage'].'" name="page" id="page">
                      <input type="hidden" value="changepassword" name="type" id="type">
                        <input type="hidden" value="'.$id.'" name="userid">
             <table width="90%">
                    <tr>
                        <td width="63px" colspan="3" class="smallfont">Dont share your password with anyone. Password must be atleast 6 characters. For password to be secure you must use alphanumeric password and some special characters.</td>
                    </tr>
                    <tr>
                        <td  >Current Password</td>
                        <td >:</td>
                        <td ><input type="password" name="pas" id="pass" value=""></td>
                    </tr>
                    <tr>
                        <td >New Password</td>
                        <td >:</td>
                        <td ><input type="password" name="npass" id="npass" value=""></td>
                    </tr>
                    <tr>
                        <td >Confirm Password</td>
                        <td >:</td>
                        <td ><input type="password" name="cpass" id="cpass" value=""></td>
                    </tr>
                    <tr>
                    <td></td><td></td><td><input  type="submit" class="button" value="Save" name="changepasssubmitb" id="changepasssubmitb"></td>
                    </tr>
                </table>
                
            </form>';
                 }
             }
               $body .= $view->getcmsbox('','Change Password', $data1, 'Click on the above settings to edit.');
         }
         
         else{
             if($user->haspermission('addedituser',$user->getid())){
        $body .= $view->getcmsbox('','User Management', "<div id='userlist'>List of registered User</div><div class='tasklist'>".getuserlist()."</div>", 'View pages of website',array('Add New User'=>"?subpage=".$_GET['subpage']."&adduser")); 
        }else{
             $body .= $view->getcmsbox('','User Management', "<div id='userlist'>List of registered User</div><div class='tasklist'>".getuserlist()."</div>", 'View pages of website'); 
        }
    }
    
                function getuserlist($id=''){
        global $db,$user;
           $q="SELECT * from users_info";
           $ro=$db->querydb($q);
            if($ro->num_rows){
                $val="";
                $val.="<ul>";
                while($r=$ro->fetch_object()){
                    $val.="<li>";
                     if($r->id!='superadmin'){
                     if($user->getid()!=$r->id){
                    $val.="<a>".$r->fname." ".$r->lname."</a>";
                     if($user->haspermission('addedituser',$user->getid())){  
                    $val.="<a class='button' href='?subpage=".$_REQUEST['subpage']."&editprofile=".$r->id."'>Edit</a>".
                    "<a class='button' href='?subpage=".$_REQUEST['subpage']."&deleteuser=".$r->id."' onclick='return confirm(\"Are You Sure You Want To Delete This User? \");'>Delete</a>"."
                    <a class='button' href='?subpage=".$_REQUEST['subpage']."&changepassword=".$r->id."'>Change Password</a></li>";
                }
                     }
                }
                }
                $val.="</ul>";
                return $val;
            }    
    }
?>