<?php
    $body = '';
    $include_file = 'includes/'.$subpage.'.php';
    if(file_exists($include_file)){
        require_once($include_file);
    }else{
        $body = 'No Action Available';
    }
?>