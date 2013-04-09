<?php
if(isset($_REQUEST['testconn'])){
    if ($_REQUEST['testconn'] == true) {
    $hostname = trim($_REQUEST['hostname']);
    $username = trim($_REQUEST['dbusername']);
    $password = trim($_REQUEST['password']);
    $database = trim($_REQUEST['dbname']);
    $errvar = false;
    $link = mysql_connect($hostname, $username, $password);
   
    if (!$link) {
        echo "<p class='red'>Error: Could not connect to the server. Please check your inputs and try again!</p>\n";
        echo "<p class='red'>Description : ".mysql_error()."</p>";
        getform('db');
        $errvar=true;
        exit();
    }else{
        echo "<p class='green'>Hostname : Test Successful!</p>\n";
    }
    
    if ($link && !$database) {
        echo "<p class='red'>Database : Please check your database, username and password.</p>\n";
        mysql_select_db($database, $link);
        echo "<p class='red'>Description :".mysql_errno($link) . ": " . mysql_error($link). "</p>\n";
        getform('db');
        $errvar=true;
        exit();
    }
    
    if ($database) {
        $dbcheck = mysql_select_db("$database");
        if (!$dbcheck) {
             echo "<p class='red'>Database : No Database found with the provided name.</p>\n";
             mysql_select_db($database, $link);
             echo "<p class='red'>Description : ".mysql_errno($link) . ": " . mysql_error($link). "</p>\n";
             getform('db'); 
             $errvar=true;
             exit();
        }else{
            echo "<p class='green'>Database : Test Successful!</p>\n";
        }
    }
    
    if(!$errvar){
        $values= array(
        'hostname'=>$hostname, 
        'username'=>$username, 
        'password'=>$password, 
        'database'=>$database
        );
       echo createconfigfile($values);
       echo '<form action="?id=UCONFIG">
            <input type="hidden" name="nav_id" value="3'.uniqid().'">
            <input type="hidden" name="cms_installation" value="'.uniqid().'">
            <input type="hidden" name="install_id" value="'.uniqid().'">
            <input type="submit" value="Continue" class="button">
            </form>
       
       ';
    }else{
        echo "<p class='red'>Error: Please check your connections before continuing.</p>\n";
        echo "<p class='red'>Possible Cause: Problem creating table or Table already present. Drop table dbconfig if exist.</p>\n";
        getform('db');
    }

 }
}
elseif(isset($_REQUEST['userconfig'])){
   $password=$_REQUEST['password'];
   $fname=$_REQUEST['fname'];
   $lname=$_REQUEST['lname'];
   $email=$_REQUEST['email'];
   $mobile=$_REQUEST['mobile'];
   $err='';
   if(preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $fname)){
       $err.="<p class=red>First Name must contain alphabets only.</p>";
   }
   if($lname!=''){
        if(preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $lname)){
            $err.="<p class=red>Last Name must contain alphabets only.</p>";
       }    
   }
   if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       $err.="<p class=red>E-Mail ID not valid.</p>";
   }
   if(strlen($mobile)!=10){
       $err.="<p class=red>Mobile number not valid.</p>"; 
   }
   if($password=='' || $_REQUEST['cpassword']==''){
       $err.="<p class=red>Password Field cannot be left blank.</p>";
   } 
   if($password!=$_REQUEST['cpassword']){
       $err.="<p class=red>Password confirmation failed.</p>";
   }
   if(!preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $password)){
       $err.="<p class=red>Password must be alpha numeric.</p>";
   }
   if($err!=''){
       echo $err;
       echo getform('user');
   }else{
       require_once("userinstallation.php"); 
        echo '<p class=green>User Configuration Saved.</p>';
        echo '<form action="?id=UCONFIG">
            <input type="hidden" name="nav_id" value="4'.uniqid().'">
            <input type="hidden" name="cms_installation" value="'.uniqid().'">
            <input type="hidden" name="install_id" value="'.uniqid().'">
            <input type="submit" value="Finish" class="button">
            </form>
       
       ';
   }
}

    function getform($type){
        if($type=='db'){
          return require_once("dbconfig.php");  
        }elseif($type=='user'){
          require_once("uconfig.php");    
        }   
    }
    
    function createconfigfile($values){
        $db=new db($values['database'], $values['hostname'], $values['username'], $values['password'] );
              $filedir='.'.'\\'.'config';
              $filename='dbconfig.php';
              $fileaddress=$filedir.'\\'.$filename;
                            
              if(!file_exists($filedir)) //part A
              {
                    mkdir($filedir);//directory created
              }
              if(!file_exists($fileaddress)){
                  $fhandle= fopen($fileaddress,'w+');
                  fclose($fhandle);
              }
                  // Let's make sure the file exists and is writable first.
              if (is_writable($fileaddress)) {
                      // The file pointer is at the bottom of the file hence
                      // that's where $filecontent will go when we fwrite() it.
                        if (!$handle = fopen($fileaddress, 'a')) {
                        echo "Cannot open file (".$fileaddress.")";
                        return FALSE;
                        }
                         // Write $filecontent which is of array type and stored in $vals to our opened file.
                         if (fwrite($handle, encrypt(json_encode($values))) === FALSE) {
                        // echo "Cannot write to file ($fileaddress)";
                         }
                         fclose($handle);
                         $db->replace('dbsettings', $values);
                         return "<p class=green>Configurations Saved</p>";
                  } 
                 return '<p class="red">Fatal Error: Configurations not saved. Please try again!</p>';
    }
?>