<?php
    if(isset($_GET['pagename'])){
        $re = $db->querydb("SELECT * FROM errorlog WHERE ERRORID = '".$_GET['pagename']."'", true);
        if($re){
            echo '<blockquote>';
            echo 'Error Number: '.$re->ERRORNO."<br>";
            echo 'Error File: '.$re->ERRORFILE."<br>";
            echo 'Error Line: '.$re->ERRORLINE."<br>";
            echo 'Error Occured: '.getRelativeTime($re->added)."<br>";
            echo '</blockquote>';
        }
    
    }
 ?>
<div style="padding-left: 90%;padding-bottom: 1%;"> <input type="button" class="button" value="cancel" onclick="cancelprofileedit(this)"></div>