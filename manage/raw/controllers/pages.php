<?php
   //Add new pages
    if(isset($_REQUEST['type']) && $_REQUEST['type']== ''){
       
        if($contentpages->createpage($_REQUEST['pagetitle'], $_REQUEST['pagecontent'],$_REQUEST['selectparent'], $_REQUEST['priority'])){
            $success = 'alertnreload';
            $result = 'Page Created';
        }
    }
    //update a page
    if(isset($_REQUEST['type']) && $_REQUEST['type'] != ''){
         if($contentpages->setcontent($_REQUEST['type'], $_REQUEST['pagetitle'], $_REQUEST['pagecontent'],$_REQUEST['selectparent'], $_REQUEST['priority'])){
            $success='alertnreload';
            $result = 'Last updated '.getRelativeTime(time())." by ".$user->getfullname();
        }else{
            $errorvar = 'Error in updating';
        }
    }
?>
