<?php
  /**
  * this file provides html only.
  * 
  * it gets the data in predefined format and gives output in html.
  */
  
  class view{
      /**
      * this function creates a page structure
      * position for navigation, body, footer, help tips, CSS style, JS/JQ scripts and error are predefined in structure.
      * 
      */
      private static $ajax = FALSE;
      
      private static $page = '';
      
      function getnav($name, $curpage = ''){
            global $db;
            $re1=$db->querydb("SELECT * FROM page_tree WHERE parent='".$name."' ORDER BY priority, name");
            $list = '';
            if($re1->num_rows){
                while($ro1=$re1->fetch_object()){
                    $q = "SELECT title FROM pages WHERE name='".$ro1->name."' ORDER BY added DESC";
                    $r = $db->querydb($q, true);
                    $sublist = $this->getnav($ro1->name, $curpage);
                    if($sublist != ""){
                        $span = "<span></span>";
                        $link = "#";
                    }else{
                        $span = "";
                        $link = "?page=".$ro1->name;
                    }
                    $list .= '<li><a ';
                    if($curpage == $ro1->name){
                        $list .= 'class="selected" ';
                    }
                    $list .= 'href="'.$link.'">'.$r->title.$span.'</a>
                      '.$sublist.'
                      </li>';
                
                }
            }
            if($list == ""){
                return "";
            }
            return "<ul>".$list."</ul>";
      }
      
    /*  function getsubnav($pages, $type, $pageid, $subpage){
          global $user;
          $r = '<ul class="'.$type.'"  id="leftsubnav">';
          $p = '';
          if($user->getusertype() == 'parent' && get('studentid')){
              $p = '&studentid='.$_GET['studentid'];
          }
          foreach($pages as $k => $v){
              $r .= '<li><a href="?page='.$pageid.'&type='.$type.'&subpage='.$k.$p.'" ';
              if($k == $subpage){
                  $r .= 'class="main_nav" ';
              }
              $r .= '>'.$v.'</a></li>';
          }
          $r .= '</ul>';
          return $r;
      }*/
      
      function htmlframe($data, $page = ''){
          global $user;
          if($page == 'home'){
              $theme = 'home.php';
          }else{
              $theme = 'internal.php';
          }
          ob_start();
          require_once('view/'.$theme);
          $d = ob_get_contents();
          ob_end_clean();
          foreach($data as $k => $v){
              while(substr_count($d, '[#:@`'.$k.'`]') > 0){
                  $d = str_replace('[#:@`'.$k.'`]', $v, $d);
              }
          }
          return $d;
      }
      
      function getbody($name){
          global $contentpages;
          //TODO: On login error needs to be handled.
            $a = $contentpages->getcontent($name);
            
          return $a;
      }
      
      function bodyinnerframe($nav, $body, $page, $subpage, $st_id = ''){
          return '<a name="loggedin"></a>
            <div style="overflow:auto; border-top:1px solid #666; margin:10px 0;">
                <div style="overflow:auto; min-height: 200px; border-left: 1px solid #aaa;">'.$body.'</div>
            </div>
          ';
      }
      
  }
?>
