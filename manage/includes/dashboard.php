<?php 
if($user->haspermission('addpage',$user->getid())){
$body .= $view->getcmsbox('historypage','Recently Added Pages', "<div class='tasklistdashbord'>".getpageshistory()."</div>", 'View pages of website',array('Add New Page'=>"?subpage=pages&addpage"));
}else{
    $body .= $view->getcmsbox('historypage','Recently Added Pages', "<div class='tasklistdashbord'>".getpageshistory()."</div>", 'View pages of website');
}

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
        return '';
        }
    }
    ?>