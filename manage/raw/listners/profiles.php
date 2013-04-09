<?php
    if(isset($_GET['pagename']) && $_GET['pagename'] == 'fullname'){
        ?>
            <form action="controller.php" method="post" class="ajaxsubmitform">
            <input type="hidden" value="profiles" name="page" id="page">
            <input type="hidden" value="fullname" name="type" id="type">
            <input type="hidden" value="" name="ajaxrequest" id="ajaxrequest">
                <table width="100%">
                    <tr>
                        <td width="63px" colspan="3" class="smallfont">This name will appear in the posts(if applicable) and changes you made to the website.</td>
                    </tr>
                    <tr>
                        <td width="63px">First Name</td><td>:</td><td><input type="text" name="fname" id="fname" value="<?php echo $user->getfirstname(); ?>"></td>
                    </tr>
                    <tr>
                        <td>Last Name</td><td>:</td><td><input type="text" name="lname" id="lname" value="<?php echo $user->getlastname(); ?>"></td>
                    </tr>
                    <tr>
                        <td></td><td></td><td><input type="submit" class="button" value="Save" name="fullnamesubmitb" id="fullnamesubmitb"><input onclick="cancelprofileedit(this)" type="button" value="Cancel" class="button"></td>
                    </tr>
                </table>
            </form>
        <?php
    }
    if(isset($_GET['pagename']) && $_GET['pagename'] == 'email'){
        ?>
            <form action="controller.php" method="post" class="ajaxsubmitform">
            <input type="hidden" value="profiles" name="page" id="page">
            <input type="hidden" value="" name="ajaxrequest" id="ajaxrequest">
            <input type="hidden" value="email" name="type" id="type">
                <table width="100%">
                    <tr>
                        <td width="63px" colspan="3" class="smallfont">This is your recovery email. If you forget your password an recovery mail will be sent to your this E-Mail ID.</td>
                    </tr>
                    <tr>
                        
                        <td width="63px">E-Mail ID</td>
                        <td>:</td>
                        <td><input type="text" name="email" id="email" value="<?php echo $user->getemail(); ?>"></td>
                    </tr>
                    <tr>
                        <td></td><td></td><td><input type="submit" class="button" value="Save" name="emailsubmitb" id="emailsubmitb"><input onclick="cancelprofileedit(this)" type="button" value="Cancel" class="button"></td>
                    </tr>
                </table>
            </form>
        <?php
    }
    if(isset($_GET['pagename']) && $_GET['pagename'] == 'password'){
        ?>
            <form action="controller.php" method="post" class="ajaxsubmitform">
            <input type="hidden" value="profiles" name="page" id="page">
            <input type="hidden" value="password" name="type" id="type">
            <input type="hidden" value="" name="ajaxrequest" id="ajaxrequest">
                <table width="100%">
                    <tr>
                        <td width="63px" colspan="3" class="smallfont">Don't share your password with anyone. Password must be atleast 6 characters. For password to be secure you must use alphanumeric password and some special characters.</td>
                    </tr>
                    <tr>
                        <td>Current Password</td>
                        <td>:</td>
                        <td><input type="password" name="pass" id="pass" value=""></td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td>:</td>
                        <td><input type="password" name="npass" id="npass" value=""></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td>:</td>
                        <td><input type="password" name="cpass" id="cpass" value=""></td>
                    </tr>
                    <tr>
                        <td></td><td></td><td><input type="submit" class="button" value="Save" name="changepasssubmitb" id="changepasssubmitb"><input onclick="cancelprofileedit(this)" type="button" value="Cancel" class="button"></td>
                    </tr>
                </table>
            </form>
            
        <?php
    }
    if(isset($_GET['pagename']) && $_GET['pagename'] == 'users'){
        ?>
                <table width="100%">
                    <tr>
                        <td colspan="3" class="smallfont">[Administrator Only] Below is the list of registered users you can add/edit/delete users from the following list.</td>
                    </tr>
                    <?php
                    $count=0;
                    foreach($user->getusers() as $k=>$v){
                        $count=$count+1;
                        $u = $user->getuserinfo($v['id']);
                        echo '<tr height="25px">
                                <td title="'.$u->email.'">'.$count.'.'.' '.$u->fname.' '.$u->lname.'</td>
                                <td style="text-align:right;">'.'Added '.getRelativeTime($u->added).'</td>
                                <td>
                                     
                                     <a href="controller.php?page=profiles&ajaxrequest=true&type=userdel&id='.$u->id.'" class="deleteuser">Delete</a></td> 
                              </tr>';
                    }
                   echo' <tr><td></td><td></td><td></td><td width=10px></td><td></td><td><input onclick="cancelprofileedit(this)" type="button" value="Cancel" class="button"></td></tr>';
                     ?>
                   
                    
                </table>
              
        <?php
    }
    
?>