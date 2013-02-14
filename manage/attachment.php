<?php
  require_once("lib/library.php");
if(isset($_GET['id'])){
    $q = "SELECT * FROM bt_attachment WHERE id = '".$_GET['id']."'";
    $re = $db->querydb($q, true);
    if($re){
        // We'll be outputting a PDF
        header('Content-type: '.$re->filetype);

        // It will be called downloaded.pdf
        header('Content-Disposition: attachment; filename="'.$re->name.'"');

        // it will write the content in file to be downloaded.        
        echo $re->data;
    }
}elseif($_GET['deletefile']){
    $q = "DELETE FROM bt_attachment WHERE id = '".$_REQUEST['deletefile']."' && name='".$_REQUEST['filename']."'";
    if($db->querydb($q)){
        echo "File Deleted.";
    }
}
?>