<!DOCTYPE html>
<html>
<head>
<title>CMS Installation</title>
<link rel="stylesheet" type="text/css" href="styles/install.css">
<SCRIPT type="text/javascript">
    window.history.forward();
</SCRIPT>
</head>
<body  >
 <?php
 require_once("install/lib.php");
 //checks for previous installation
 if(file_exists("config/dbconfig.php") && file_exists("config/log.txt")){
        echo '<div class="red" style="padding:10px">Script execution failed. Please check log.txt for more information. <a href="index.php">Back to home</a></div>';
        createfile('log.txt', 'Installation already performed. Please clean up the browser cache and remove all files from config folder to perform the installation again. Also Clean up database where you want to install the cms.');
        exit();
  }
 $index='0';
 $itype='';
 $top_msg='';
                if(isset($_REQUEST['cms_installation'])){
                    if($_REQUEST['install_id']!=''){
                         $index=substr($_REQUEST['nav_id'],0, 1);
                         $itype=$install_pos[$index];
                         $top_msg='<b>'.$itype.'</b>';
                    }else{
                         $top_msg='<b>Something went wrong. Please check your PHP and Server Configuration files!</b>';
                    }
                   
                }else{
                         $top_msg='<b>Installation Confirmation Page</b>';
                }
 ?>


  <div class="wrapper">
        <header>
            <div class="logo">CMS Installation Wizard</div>
        </header>
        <div class="container">
            <div class="content_left">
            <?php
            echo '<ul>';
                foreach($install_pos AS $k=>$v){
                    if($index==$k){
                        echo '<li class="selected">'.$v.'</li>';
                    }else{
                        echo '<li>'.$v.'</li>';
                    }   
                }
            echo '</ul>';
            ?>
            </div>
           <div class="content">
            
            <div class="content_right_top">
                 <div>
                   <?php
                   echo $top_msg;
                   ?>
                 </div>
            </div>
            <div class="content_right_bottom">
                <div>
                <?php
                if(($index!=null)&&($index!='')){
                    if(isset($_REQUEST['testconn']) || isset($_REQUEST['userconfig'])){
                       require_once('./install/testconn.php'); 
                    }
                    else{
                       require_once('./install/'.$install_file[$index]);
                    }
                }else{
                    echo '<i>Error loading module.</i>';
                }
                ?>
                </div>
            </div>

            </div>
        </div>
        <footer>
            <ul>
                <li><a href="#">Policy Policy</a></li>
                <li>|</li>
                <li><a href="#">Help & Support</a></li>
                <li>|</li>
                <li><a href="#">Product Features</a></li>
            </ul>
        </footer>
    </div>
</body>
</html>
