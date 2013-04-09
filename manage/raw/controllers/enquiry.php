<?php
    if(isset($_REQUEST['type'])){
        if($_REQUEST['msg'] != ""){
            $values = array(
                            'id'     =>  uniqid(),
                            'enqid'  =>  $_REQUEST['type'],
                            'msg'    =>  $_REQUEST['msg'],
            );
            if($db->insert("enquiryremarks", $values)){
                
                $updateresult = '
                <div class="boxslip">
                    <div class="left boxtitleslip">
                        <div>'.$user->getfirstname().'</div>
                    </div>
                    <div class="right boxtitleslip">
                        <div>'.getRelativeTime(time()).'</div>
                    </div>
                    <div class="boxslipbody left">
                        <div>'.$values['msg'].'</div>
                    </div>
                </div>
                                ';
            }else{
                $errorvar = 'Message not saved.';
            }
        
        }
    }
    elseif(isset($_REQUEST['delenq'])){
        if($db->delete('enquiries', "id = '".$_REQUEST['delenq']."'")){
            $result = 'delrow';
        }else{
            $errorvar = "Can not delete row.";
        }
    }
?>
