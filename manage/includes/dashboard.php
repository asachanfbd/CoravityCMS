<?php 
if($user->haspermission('addpage',$user->getid())){
    if(getpageshistory()==false){
        $d='';
    }else{
        $d='Recently Added Pages';
    }
    $add=array('Add New Page'=>"?subpage=pages&addpage");
    $body .= $view->getcmsbox('historypage', $d, "<div class='tasklistdashbord'>".getpageshistory()."</div>", 'View pages of website', $add);
}else{
    if(getpageshistory()==false){
        $d='';
    }else{
        $d='Recently Added Pages';
    }
    $body .= $view->getcmsbox('historypage', $d, "<div class='tasklistdashbord'>".getpageshistory()."</div>", 'View pages of website');
}
//$body .= $profiler->display();
function getpageshistory(){
        global $db,$contentpages,$user;
        $q="SELECT * from page_tree ORDER by added DESC limit 10";
        $ro=$db->querydb($q);
        if($ro->num_rows){
            $val='<ul>';
            while($re=$ro->fetch_object()){
                $val .="
                    <li><a>".$contentpages->gettitle($re->name)."<span class='tabrowcontentdashboard'>"."<div style='float:right;padding-top:5px'>"."Added  ".getRelativeTime($re->added)."</div>"."</span>"."</a>"."</li>";
            }
            $val.='</ul>';
            return $val;
        }else{
        return false;
        }
    }
    ?>