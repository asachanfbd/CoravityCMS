<?php
  require_once('lib/library.php');
  if(isset($_REQUEST['radiofp'])){
      $value=$_REQUEST['radiofp'];
      if($value=='email'){
          $email=$_REQUEST['email'];
          if(validatemail($email)){
              global $db;
                $re = $db->querydb("SELECT * FROM users_email WHERE email = '".$email."'", true);
                if($re){
                    //code pending
                    header("Location: forgotpass.php?user_details_sent");
                }else{
                        header("Location: forgotpass.php?email_id_not_registered&value=".$email.'"');
                    }     
               }   
          }else{
              header("Location: forgotpass.php?invalid_email_id");
          }
  }
  if($value=='mobile'){
          $mobile=$_POST['mobile'];
          $flag=true;
          if($mobile!=''){
              if(ctype_digit($mobile)){
                  if(strlen($mobile)==10){
                      global $db;
                      $re = $db->querydb("SELECT * FROM users_info WHERE mobile = '".$mobile."'", true);
                      if($re){
                      //code pending
                        header("Location: forgotpass.php?user_details_sent");
                      }else{ 
                        header("Location: forgotpass.php?mobile_number_not_registered&value=".$mobile.'"');
                      }     
                  }else{
                      $flag=false;
                  }
              }else{
                      $flag=false;
                  }
          }else{
                      $flag=false;
          }
          if($flag==false) {
           header("Location: forgotpass.php?invalid_mobile_number");
          }
      }
      if($value=='other'){
          $mobile=false;
          $email=false;
          
          $un=$_REQUEST['user_name']; $ue=$_REQUEST['user_email']; $um=$_REQUEST['user_mobile'];
          $umsg=$_REQUEST['user_message'];
          
          $string='&un='.$un.'&ue='.$ue.'&um='.$um.'&umsg='.$umsg;
          if($un!='' && $ue!='' && $um!='' && $umsg!=''){
              if($ue){
                  if(validatemail($ue)){
                      $email=true;
                  }else{
                      $email=false;
                  }
              }else{
                  $email=true;
              }
              if($email==true){
              if(ctype_digit($um)){
                  if(strlen($um)==10){
                      $mobile=true;
                  }else{
                      $mobile=false;
                  }
              }else{
                  $mobile=false;
              }
                if($mobile==true){
                $str= '<div style="">       
<table cellpadding="0" cellspacing="0" border="1">
    <tr>
        <th>Parent\'s Name</th>
        <td>'.$pn.'</td>
         <th>EMail ID</th>
        <td>'.$pe.'</td>
    </tr>
    
    <tr>
        <th>Mobile No.</th>
        <td>'.$pm.'</td>
        <th>Student\'s Name</th>
        <td>'.$sn.'</td>
    </tr>

    <tr>
        <th>Name of School</th>
        <td>'.$ns.'</td>
        <th>Class</th>
        <td>'.$sc.'</td>
    </tr>

    <tr>
        <th>Section</th>
        <td>'.$ss.'</td>
        <th>Roll No.</th>
        <td>'.$sr.'</td>
    </tr>
    
    <tr> 
    <th colspan="2">Message</th>
        <td colspan="2">
          <div style="padding: 5px; text-align: left; width: 400px; height: 200; overflow: auto; float: left ">
               '.$msg.'
          </div>   
        </td>
    </tr>

</table>
</div>';    
                $vals=array(
                            'id'        => uniqid(),
                            'form_data' => $str,
                            'mobile'    => $pm,
                            'email'     => $pe
                );  
                $qr=$db->insert('bt_pswd_recovery_form', $vals);   
                    if($qr){
                    header("Location: forgotpass.php?form_submitted");    
                    }
                    else{
                    header("Location: forgotpass.php?invalid_field_values".$string);
                    }
                }else{
                header("Location: forgotpass.php?invalid_field_values".$string);
                }
              }else{
                header("Location: forgotpass.php?invalid_field_values".$string);
              }
          }
          else{
          header("Location: forgotpass.php?invalid_field_values".$string);
          }
  }

  if(isset($_REQUEST['form_submitted'])){
      header("Refresh:15;index.php");
      $disp = 'Your form has been submitted successfully. It may take 3-4 days to resolve your problem.';
      
  }
  
  if(isset($_REQUEST['user_details_sent'])){
      header("Refresh:15;index.php");
      $disp = "<div style='color:green'>We have sent your username and password via email/sms.</div>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Password Help - CMS | Coravity Infotech</title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script>
        $(document).ready(function(){ 
             $(".radiobut").change(function(){
                    showbox($(this).attr('value'));
                
             });
             var val1 = $('input[name=radiofp]:checked', '#forgotpassform').val();
             if(val1 != 'undefined'){
             showbox(val1);
             }
            });   
        function showbox(val){
        
            if(val == 'username'){
                $("#panel1").slideDown("slow");
                $("#panel2").slideUp("slow");
                $("#panel3").slideUp("slow");
                $("#panel4").slideUp("slow");
              
            }else if(val =='email'){
              $("#panel2").slideDown("slow");
                $("#panel1").slideUp("slow");
                $("#panel3").slideUp("slow");
                $("#panel4").slideUp("slow");
              
            }else if(val == 'mobile'){
                $("#panel3").slideDown("slow");
                $("#panel2").slideUp("slow");
                $("#panel1").slideUp("slow");
                $("#panel4").slideUp("slow");
              
            }else if(val == 'other'){
                $("#panel4").slideDown("slow");
                $("#panel3").slideUp("slow");
                $("#panel2").slideUp("slow");
                $("#panel1").slideUp("slow");
            }
        }
        function clear(){
            document.getElementById('forgotpassform').reset();
        }
        </script>
        <style type="text/css"> 
          body{
                font-style: tahoma; 
                font-family: Trebuchet MS; 
                font-size: 13px;
                overflow-y: scroll;
                margin: 0 auto;
                background-position: -413px -69px;
            }
            .flip{
            padding: 5px 0px 5px 30px;
            display:none;
            color: #aaa;
            }
            #btn{
                padding-left: 23px;
                padding-top:10px;
            }
            #submit{
                width: 98px;
                height:28px;
                cursor: pointer; 
                background-color: #51BCEA;
                border: medium none;
                color:#fff;
                text-shadow:0 1px rgba(0, 0, 0, 0.1);
            }
            #submit:hover{
               background-color: #313131; 
            }
            .label{
                cursor: pointer;
            }
            #msg{
                width: 500px;
                margin: 100 auto;
                height: 200px;
                padding:20px; 
                font-size: 14px;
            }
            #gificon{
                padding-bottom: 15px;
            }
                .login_main{
                    width: 850px;
                    font-family: verdana;
                    font-size: small;
                    margin: 0 auto;
                }
                .login_main .login_body{
                    width: 100%;
                    overflow: auto;
                    color: #34363d;
                }
                .login_main .login_body .login_body_info{
                    width: 45%;
                    padding: 1%;
                    float: right;
                    margin-top: 50px;
                }
                .login_main .login_body .login_body_info .info{
                    margin: 0.1%;
                }
                .login_main .login_body_form{
                    margin: 2% 1%;
                    margin-top: 10px;
                    padding: 1%;
                    width: 80%;
                    float: left;
                }
                .login_main .login_footer{
                    margin: 0.1%;
                    width: 100%;
                }
                .input{
                    width: 100%;
                    margin: 0.5% 0 1.5% 0;
                    border: 1px solid #000;
                }
                .input input{
                    margin: 2% 3%;
                    border: none;
                    width: 90%;
                }
                .button{
                    float: left;
                    font-weight: bold;
                }
                .button>a{
                    background-color: #51bcea;
                    display: block;
                    text-decoration: none;
                    color: #fff;
                    padding: 7% 20%;
                    text-align: center;
                }
                .button>a:hover{
                    background-color: #313131;
                }
                .check{
                    float: left;
                    clear: right;
                    padding: 0.4%;
                    margin: 0.5% 0 0 1%;
                }
                .check input{
                    height: 10px;
                }
                .lower{
                    clear:both;
                    margin: 5% 0 1.2% 0;
                    font-size: 11px;
                }
                .lower>a{
                    text-decoration: none;
                    color: #2672ec;
                }
                .lower>a:hover{
                    text-decoration: underline;
                }
                .top_form{
                    overflow: auto;
                    font-size: 15px;
                }
                .top_form>div:first-child{
                    float: left;
                }
                .top_form>div:nth-child(even){
                }
                .ots_form{
                    margin-top: 30px;
                }
                .features{
                    list-style-type: none;
                    padding-left: 0px;
                    overflow: auto;
                }
                .features>li{
                    width: 52%;
                    float: left;
                    margin: 5px 0px;
                    overflow: auto;
                }
                .features>li>img{
                    float: left;
                }
                .title{
                    float: left;
                    margin: 6px 0px 10px 6px;
                }
                .title>p:first-child{
                    margin: 0px;
                    font-weight: bold;
                }
                .title>p:nth-child(even){
                    margin: 0px;
                }
                .main_container{
                    margin: 14px;
                }
                .learn{
                    float: left;
                    font-size: 11px;
                    margin-top: 27px;
                }
                .learn>a{
                    color: #51BCEA;
                    text-decoration: none;
                }
                .learn>a:hover{
                    text-decoration: underline;
                }
                .ots_link{
                    list-style-type: none;
                    padding-left: 0px;
                    font-size: 11px;
                    margin-top: 30px;
                }
                .ots_link>li{
                    float: left;
                }
                .ots_link>li>a{
                    text-decoration: none;
                    margin-right: 13px;
                    color: #51bcea;
                }
                .ots_link>li>a:hover{
                    text-decoration: underline;
                }
                #footer_div{
                    margin-top: 25px;
                    color: #34363d;
                    letter-spacing: 1px;
                    border-top: 1px solid #51bcea;
                }
                #footer_div>div{
                    margin-top: 10px;
                    overflow: auto;
                }
                #footer_div div>div{
                    float:left;
                    color: #34363d;
                    padding: 6px 1px;
                    margin: 0px;
                    font-size: 12px;
                }
                #footer_div div>a:hover{
                    color:#51bcea;
                    text-decoration: underline;
                }
                #footer_div div>a{
                    text-decoration: none;
                     color:#555;
                     font-size: 11px;
                }
                .cms_footer_nav{
                margin: 0; 
                padding: 0; 
                overflow: auto; 
                list-style-type: none;   
            }
            .cms_footer_nav li{
                float:left;
                padding: 2px;
            }
            .cms_footer_nav li a{
                color: #51bcea;
                text-decoration: none;
            }
            .cms_footer_nav li a:hover{
                text-decoration: underline;
                color: #8080FF;
            }
               
        </style>
    </head>
<body>
    <div class="login_main">
        <div class="login_body">
             <div class="login_body_form">
                 <div class="top_form" style="margin-bottom: 50px; margin-left: -15px;">
                    <div>
                        <a href="index.php"><img id="logo" src="images/logo-name.png" width="100%" alt="Coravity Infotech"></a>
                    </div> 
                 </div>
<?php

  if(isset($_REQUEST['invalid_username'])){
    displaymessage("Invalid Username.");
  }
  if(isset($_REQUEST['invalid_email_id'])){
  displaymessage("Invalid Email ID.");
  }
  if(isset($_REQUEST['email_id_not_registered'])){
    displaymessage("This email id is not registered with us.");
  }
  if(isset($_REQUEST['invalid_mobile_number'])){
    displaymessage("Invalid Mobile Number.");
  }
  if(isset($_REQUEST['mobile_number_not_registered'])){
    displaymessage("This Mobile number is not registered with us.");
  }
  if(isset($_REQUEST['invalid_field_values'])){
    displaymessage("Incorrect Form Data.");
  }
  if(isset($disp)){
      displaymessage($disp, true);
  }
function displaymessage($msg, $status=false){
    //will always accept true in case of successful form submission

    if($status){ 
    echo '<div id="msg">';
    echo $msg .'<div><h5>Please wait redirecting to Login page in '; 
                  echo'<script language="javascript">
                  var time_left = 15;
                  var cinterval;
                  function time_dec(){
                  time_left--;
                  document.getElementById("countdown").innerHTML = time_left;
                  if(time_left == 0){
                    clearInterval(cinterval);
                  }
                  }
                  cinterval = setInterval("time_dec()", 1000);
                  </script>';
                  echo'<span id="countdown">15</span>';
    echo ' Seconds<h5></div>';
    echo '
    <br>';
    echo '<div style="padding-top: 14px; font-size:12px">
    If this page is taking too much time <a href="index.php" style="text-decoration:none">click here.</a><br>
    It may take upto 15 minutes for sms and email delivery. 
    </div>';
    echo '</div>';              
    }
    else{
        echo '<div id="forgotpassmain" style="color: #FF0000">*'.$msg.' '.'Please try again!'.'</div>';
    }
}
    
if((count($_REQUEST)==0)||((!isset($_REQUEST['user_details_sent']))&&(!isset($_REQUEST['form_submitted'])))){
?>

<div id="forgotpassmain">
<div style="font-size: 18px; padding-bottom: 10px;">Having trouble signing in? Get your password from here.</div>
<form action="forgotpass.php" method="POST" id="forgotpassform">
<input type="radio" id="radio1" class="radiobut" value="username" name="radiofp"  <?php if(isset($_REQUEST['invalid_username'])){echo 'checked="checked"';} ?>><label class="label" for="radio1">I don't know my password</label></input>
<br>
<div id="panel1" class="flip">
<p>Please enter Your username provided by the OTS</p>
<input type="text" value="<?php if(isset($_REQUEST['invalid_username'])){echo $_REQUEST['value'];}?>" size="30" name="username" id="in"/>
</div>

<input type="radio" id="radio2" class="radiobut" value="email" name="radiofp" <?php if((isset($_REQUEST['invalid_email_id']))||(isset($_REQUEST['email_id_not_registered']))){echo 'checked="checked"';} ?>><label class="label" for="radio2">I don't know my username</label></input>
<br>
<div id="panel2" class="flip">
<p>Please enter your email id registered with the ots account. <br>We will mail your password reset link there.</p>
<input type="text" size="30" value="<?php if((isset($_REQUEST['invalid_email_id']))||(isset($_REQUEST['email_id_not_registered']))){echo $_REQUEST['value'];}?>" maxlength="50" name="email" id="in" placeholder="yourname@example.com"/>
</div>


<input type="radio" id="radio3" class="radiobut" value="mobile" name="radiofp"  <?php if((isset($_REQUEST['invalid_mobile_number']))||(isset($_REQUEST['mobile_number_not_registered']))){echo 'checked="checked"';} ?>><label class="label" for="radio3">I don't know my E-Mail ID</label></input>
<br>
<div id="panel3" class="flip">
<p>Please provide us your mobile number registered with the ots account. <br>We will send password through sms.</p>
<input type="text" size="30" value="<?php if((isset($_REQUEST['invalid_mobile_number']))||(isset($_REQUEST['mobile_number_not_registered']))){echo $_REQUEST['value'];}?>" maxlength="10" name="mobile" id="in" placeholder="Mobile Number"/>
</div>


<input type="radio" id="radio4" class="radiobut" value="other" name="radiofp"  <?php if(isset($_REQUEST['invalid_field_values'])){echo 'checked="checked"';} ?>><label class="label" for="radio4">I'm having other problems sigining in</label></input>
<div id="panel4" class="flip"> 
        <div>Please Fill this form to complete password recovery process:</div>
        <table style="font-size: 13px; color: #333; padding: 5px;">
        <tr colspan="2">
        <td>
        <div style="padding-bottom: 5px;">Your Name:*</div>
                     <input type="text" value="<?php if(isset($_REQUEST['invalid_field_values'])){echo $_REQUEST['pn'];}?>" maxlength="30" name="parent_name" placeholder="Father's Name"/></br>
        </td>
        </tr>
        <tr colspan="2">
        <td>
        <div style="padding-bottom: 5px;">Email ID:</div>
                <input type="text" value="<?php if(isset($_REQUEST['invalid_field_values'])){echo $_REQUEST['pe'];}?>" maxlength="50" name="parent_email" placeholder=""/></br>
        </td>
        </tr>
        <tr>
        <td colspan="2">
        <div style="padding-bottom: 5px;">Mobile No.:*</div>
                <input type="text" value="<?php if(isset($_REQUEST['invalid_field_values'])){echo $_REQUEST['pm'];}?>" name="parent_mobile" maxlength="10" placeholder=""/></br>
        </td>
        </tr>
        
        <tr>
        <td colspan="2">
        <div style="padding-bottom: 7px;">Other description:</div>
                 <textarea cols="33" rows="5" name="msg" placeholder="Write your message here" value="<?php if(isset($_REQUEST['invalid_field_values'])){echo $_REQUEST['msg'];}?>" style="max-width: 300; resize:none"></textarea></br> 
        </td>
        </tr>
        </table>
</div>


<div id="btn"><input type="submit" id="submit"  value="Submit"/>
<input type="button" id="submit" value="Cancel" onclick="window.location.href='index.php';"/>
</div>
 
 </form>
</div>
<?php  
}
?>
             </div>
             <div class="login_body_info" style="display: none;">
                 <div class="info">
                      <img src="images/ptmimg.png" >
                 </div>
                 <div class="main_container">
                      <ul class="ots_link">
                          <li><a href="http://www.braintouchonline.com/?page=about&type=mainnavigation">About Braintouch OTS</a></li>
                          <li><a href="http://www.braintouchonline.com/?page=features&type=mainnavigation">New features!</a></li>
                          <li><a href="http://www.braintouchonline.com/?page=services&type=mainnavigation">Scope of Services</a></li>
                      </ul>
                </div>
             </div>
        </div>
        <div id="footer_div">
            <div>
                <div>Copyright&copy;  2012, <a href="http://www.coravity.com" target="_blank">Coravity Infotech.</a></div>
                <div style="float: right;">
                    <ul class="cms_footer_nav">
                    <li><a href="http://www.coravity.com" target="_blank">Contact Us</a></li><li>|</li>
                    <li><a href="http://www.coravity.com" target="_blank">Support</a></li><li>|</li>
                    <li><a href="http://www.coravity.com" target="_blank">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>