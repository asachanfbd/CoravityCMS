<?php
setcookie("man",uniqid(),time()+3600*24*365);
require_once("lib/library.php");
    $data=array();
    $page='';
    $footer=array(
    'term'=> 'Term' ,
    'privacy'=> 'privacy'
    );
    
    if(isset($_GET['page']) && $_GET['page'] !="" && strtolower($_GET['page'])!="home"){
        $page=strtolower($_GET['page']);
        $data['mainbody']=$view->getbody($_GET['page']);
        //this whilw loop is for image address
        while(strstr($data['mainbody'], "../")){
            $data['mainbody'] = str_replace("../", "", $data['mainbody']);
        }
        $data['pagetitle']=$contentpages->gettitle($_GET['page']);
        $subpage = $page;
      $data['subnav'] = '';
      /*foreach($subpages as $k=>$v){
          if(array_key_exists($page, $v)){
              $page = $k;
          }
      }
      if(array_key_exists($page, $subpages)){
          $data['subnav'] = $view->getnav($subpages[$page], 'subnav', $subpage);
      }*/
    }
    else{
        $page='home';
        $data['pagetitle']="Home Page Demo";
    }
    
    $data['footer']=$view->getnav($footer,'footernav',$page);
    
    $data['mainnavigation']=$view->getnav('root', $page);
    
    echo $view->htmlframe($data,$page);    
?>