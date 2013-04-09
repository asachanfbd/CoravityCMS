<?php
    if(isset($_GET['pagename'])){
        $re = $db->querydb("SELECT * FROM errorlog WHERE error_id = '".$_GET['pagename']."'", true);
        if($re){
            echo '<blockquote>';
            echo 'Error Number: '.$re->error_no."<br>";
            echo 'Error File: '.$re->error_file."<br>";
            echo 'Error Line: '.$re->error_line."<br>";
            echo 'Error Occured: '.getRelativeTime($re->added)."<br>";
            echo '</blockquote>';
        }
    }
 ?>