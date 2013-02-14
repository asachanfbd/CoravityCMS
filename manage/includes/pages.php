<?php  
/* this will add a new page to website*/
 if(isset($_GET['addpage'])) {  
     if($user->haspermission('addeditpage',$user->getid())){ 
        $data1 = '<form action="controller.php" method="post" class="newpageaddform ajaxsubmitform">
            <input type="hidden" value="pages" name="page" id="page">
            <input type="hidden" value="" name="type" id="type">
            <input type="hidden" value="" name="ajaxrequest" id="ajaxrequest">
                <table width="100%">
                 <tr>
                        <td><input type="text" placeholder="Enter Page Title" name="pagetitle" id="title" style="width: 95%; border: 1px solid #ccc; padding: 3px 5px; "></td>
                    </tr>';
                   $data1 .='<tr><td>Select Parent :</td></tr>';
                   $data1 .='<tr><td><select name="selectparent">
                         <option value="root">Root</option>';
                         $re=$db->querydb("select distinct (`name`) from page_tree ");
                            if($re->num_rows){
                                while($ro=$re->fetch_object()){
                                $data1 .='<option value= "'.$ro->name.'" ';
                                $data1 .='>'.$contentpages->gettitle($ro->name).'</option>';
                                }
                            } 
                   $data1 .='</select><input type="text" name="priority" id="priority" placeholder="Enter Page Priority"></td>
                    </tr>';
                    $data1 .='<tr>
                        <td><textarea name="pagecontent" id="body" class="mceEditor" style="width: 98%; height: 300px;"></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Create New Page" class="button"></td></tr>
                    </tr>
                </table>
            </form>';
           $body.= $view->getcmsbox('',"Add New Page",$data1, 'Add new page to website', array("View Pages"=>"?subpage=".$_GET['subpage']));
}else{
    $data1="You are not authorized user for this action";
    $body.= $view->getcmsbox('',"Add New Page",$data1, 'Add new page to website');
}
 }



/*  This will show the content of pages*/

elseif(isset($_REQUEST['showcontent'])){
    if($user->haspermission('addeditpage',$user->getid())){
    $stat_res = '';
    if(isset($_REQUEST['Restorepage'])){
        global $db,$contentpages;
        $id=$_GET['Restorepage'];
        $val['added'] = time();
        $db->update('pages', $val, 'id = "'.$id.'"');
        $stat_res = $view->highlightsuccess('Page Restored');
    }
    if(isset($_REQUEST['deletehistorypage'])){
        $q="DELETE from pages where id='".$_REQUEST['deletehistorypage']."'";
        $r=$db->querydb($q);
        if($r){
         $stat_res = $view->highlightsuccess('Page Deleted Successfully');
        }
    }
    $data1="<div class='showhistorypage'><a>Title: ".$contentpages->gettitle($_REQUEST['showcontent'])."</a>".
            "<a>Edit By : ".$contentpages->getauthor($_REQUEST['showcontent'])." ".getRelativeTime($contentpages->getlastedited($_REQUEST['showcontent']))."</a>"."<span style='font-size:20px; margin:5px'>Content :"."</span>"."<div>".$contentpages->getcontent($_REQUEST['showcontent'])."</div>";
         $body.= $view->getcmsbox('',"Page Content",$stat_res.$data1, 'Add new page to website', array("View Pages"=>"?subpage=".$_GET['subpage'],"Edit This Page"=>"?subpage=".$_GET['subpage']."&editpage=".$_GET['showcontent'],"History"=>"?subpage=".$_GET['subpage']."&showhistory=".$_GET['showcontent']));
}else{
     $data1="<div class='showhistorypage'><a>Title: ".$contentpages->gettitle($_REQUEST['showcontent'])."</a>".
            "<a>Edit By : ".$contentpages->getauthor($_REQUEST['showcontent'])." ".getRelativeTime($contentpages->getlastedited($_REQUEST['showcontent']))."</a>"."<span style='font-size:20px; margin:5px'>Content :"."</span>"."<div>".$contentpages->getcontent($_REQUEST['showcontent'])."</div>";
    $body.= $view->getcmsbox('',"Page Content",$data1, 'Add new page to website', array("View Pages"=>"?subpage=".$_GET['subpage']));
}
}




/* this will edit the content of the page */

elseif(isset($_REQUEST['editpage'])){
        $id=$_REQUEST['editpage'];
        $data1 = '<form name="edit" action="controller.php" method="post" class="ajaxsubmitform">
            <input type="hidden" value="pages" name="page" id="page">
            <input type="hidden" value="'.$id.'" name="type" id="type">
            <input type="hidden" value="" name="ajaxrequest" id="ajaxrequest">
                <table width="100%" class="listnerbox">
                    <tr>
                        <td colspan="3" class="smallfont">Edit the content here to appear in your home page.</td>
                    </tr>
                    <tr>
                        <td>Title</td><td>:</td><td><input type="text" value="'.$contentpages->gettitle($_GET['editpage']).'" name="pagetitle" id="pagetitle" class="codelib_input_box"></td>
                    </tr>
                    <tr>
                         <td>Parent</td><td>:</td>
                         <td>
                         <select width="50px" name="selectparent">
                            <option value="root">Root</option>';
                        $re=$db->querydb("select distinct(`name`) from page_tree WHERE parent <> '".$_REQUEST['editpage']."' AND parent='root' ORDER by priority");
                            if($re->num_rows){
                                while($ro=$re->fetch_object()){
                                $data1.='<option value= "'.$ro->name.'"';
                                if($contentpages->getparent($_GET['editpage']) == $ro->name){
                                   $data1.='selected = "selected"';
                                }
                                if($_REQUEST['editpage'] == $ro->name){
                                     $data1.= 'disabled = "disabled"';
                                }
                                $data1.='>'.$contentpages->gettitle($ro->name).'</option>';
                               $data1.=getselectlist($ro->name);
                               }
                             }
                             
                           $data1.='</select>
                             &nbsp;Priority: <input type="text" name="priority" id="priority" placeholder="Enter Page Priority" value="'.$contentpages->getpriority($_GET['editpage']).'">
                             </td>
                    </tr>
                    <tr><td colspan="3">
                        Page Content
                        <textarea class="mceEditor" style="width: 90%; height: 400px;" name="pagecontent" id="pagecontent">'. $contentpages->getcontent($_GET['editpage']).'</textarea>
                        </td>
                    </tr>
                   
                    <tr>
                        <td colspan="3"><input class="button" type="submit" value="Save" name="fullnamesubmitb" id="fullnamesubmitb">
                       
                    </tr>
                </table>
            </form>';
           $body.= $view->getcmsbox('',"Edit Page",$data1, 'Add new page to website', array("View Pages"=>"?subpage=".$_GET['subpage'], "Add New Page"=>"?subpage=".$_GET['subpage']."&addpage"));
}



        /* Tis will show the history of the Every page order By modified */
        
elseif(isset($_REQUEST['showhistory'])){
    if($user->haspermission('addeditpage',$user->getid())){
    global $db,$contentpages;
    $data1='';
    $i=1;
    $q="SELECT * from pages where name='".$_REQUEST['showhistory']."'ORDER by added DESC limit 10";
    $ro=$db->querydb($q);
    if($ro->num_rows){
        while($re=$ro->fetch_object()){
            $data1.="<div class='showhistorypage'><a>Title: ".$contentpages->gettitle($re->name)."</a>".
            "<a>Edit By : ".$contentpages->getauthor($re->name)." ".getRelativeTime($re->added)."</a>"."<span style='font-size:20px; margin:5px'>Content :"."</span>"."<div>".$re->content."</div>";
            if($ro->num_rows!=1){
                 $data1.="<div id='special_div'>";
                if($i!=1){
            $data1 .="<a href='?subpage=".$_GET['subpage']."&showcontent=".$_REQUEST['showhistory']."&Restorepage=".$re->id."'class='button'>"."Restore This Page</a>";
            }
            $data1.="<a href='?subpage=".$_GET['subpage']."&showcontent=".$_REQUEST['showhistory']."&deletehistorypage=".$re->id."'class='button'>"."Delete This Page</a></div>";
            }else{
                $data1.="<div id='special_div'></div>";
            }
            $data1.="</div>";
            $i++;
        }
    }
    $body.=$view->getcmsbox('',"Page History",$data1,'Add new page to website',array("View Pages"=>"?subpage=".$_GET['subpage']));
}
else{
    $data1='You are not authorized user fro this action.';
    $body.=$view->getcmsbox('',"Page History",$data1,'Add new page to website',array("View Pages"=>"?subpage=".$_GET['subpage']));
}
}


//TODO: add a query to delete the page.
else{
      $dp = '';    
    if(isset($_REQUEST['deletepage'])){
        
        $q="DELETE from page_tree WHERE name='".$_GET['deletepage']."'";
        if($db->querydb($q)){
            $q1="DELETE from page_tree where parent ='".$_GET['deletepage']."'";
             if($db->querydb($q1)){
                 $dp = "<div style='padding: 5px; margin: 10px; border: 1px solid #000; background: red; padding-left: 20px;'>Page deleted page</div>";
    }
        }
}
 if($user->haspermission('addpage',$user->getid())){ 
$body .= $view->getcmsbox('','Pages', "<div class='tasklist'>".$dp.getpageslist()."</div>", 'View pages of website',array('Add New Page'=>"?subpage=".$_GET['subpage']."&addpage"));
 }else{
     $body .= $view->getcmsbox('','Pages', "<div class='tasklist'>".$dp.getpageslist()."</div>", 'View pages of website');
 }
}


     /* This function will return all the pages in a tree format*/
     
    function getpageslist($id = 'root'){
        global $user, $db, $contentpages;
        $q =$db->querydb("SELECT * FROM page_tree as t WHERE t.parent='".$id."' order by t.priority");
        if($q->num_rows){
            $val = '<ul>';
            while($ro = $q->fetch_object()){
                $val .= "
                <li>
                    <a href='?subpage=".$_GET['subpage']."&showcontent=".$ro->name."'>".$contentpages->gettitle($ro->name)."</a>";
                  if($user->haspermission('addeditpage',$user->getid())){ $val.=" <a class='button' href='?subpage=".$_GET['subpage']."&editpage=".$ro->name."'>Edit</a>
                    <a class='button' href='?subpage=".$_GET['subpage']."&deletepage=".$ro->name."' onclick='return confirm(\"Are you sure you want to delete this page?\");'>Delete</a>".getpageslist($ro->name)."
                </li>";
            }
            }
            $val .= "</ul>";
            return $val;
        }else{
            return '';
        }
         
    } 
    /* this function will return select list in select parent lsit*/
    
    
    function getselectlist($id=''){
        global $db,$contentpages;
         $rw=$db->querydb("select distinct(`name`) from page_tree WHERE parent <> '".$_REQUEST['editpage']."' AND parent='".$id."' ORDER by priority ");
                                if($rw->num_rows){
                                    while($r=$rw->fetch_object()){
                                 $data1.='<option value= "'.$r->name.'" ';
                                if($contentpages->getparent($_GET['editpage']) == $r->name){
                                   $data1.='selected = "selected"';  
                                }
                                if($contentpages->getparent($_GET['editpage']) == $contentpages->getparent($r->name)){
                                     $data1.= 'disabled = "disabled"';
                                }
                                $data1.='>'."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$contentpages->gettitle($r->name);
                                $data1.='</option>'.getselectlist($r->name);
                                  }
                                   return $data1;
                                }
                               
    }
    
   
?>   
            
            