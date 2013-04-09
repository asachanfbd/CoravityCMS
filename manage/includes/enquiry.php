            <?php
             
              /* 
                $re = $enquiry->getall();
                $status = 'read';
                $id=1;
                if($re){
                    $rows = array();
                    foreach($re as $v){
                        $status = 'read';
                        if($v->readstatus == '1'){
                            $status = 'unread';
                        }
                        $rows[] = $view->getcmsrow($id, $v->id, "Enquiry by ".ucfirst($v->name)." For the Service of ".$v->selcetservices, 'Submitted '.getRelativeTime($v->added), 'Open', $status);
                    $id++;
                    }
                
                    $body.=$view->getcmsbox('', 'Enquiries Received', $rows, 'Click on the above enquiries to track your follow-up.');
                }else{
                    $body.=$view->getcmsbox('', 'Enquiries Received', 'No Enqueries Received', 'Click on the above enquiries to track your follow-up.');
                }
              */ 
              
               if(isset($_REQUEST['eid'])&&(isset($_REQUEST['view']))){
                   $re=$enquiry->getenquiry($_REQUEST['eid']);
                   $id=1;
                   if($re){
                       $status = 'read';
                        if($re->readstatus == '1'){
                            $status = 'unread';
                        }
                       $d=$view->getcmsrow($_REQUEST['subpage'], $re->id, "Enquiry by ".ucfirst($re->name)." For the Service of ".$re->selcetservices, 'Submitted '.getRelativeTime($re->added), 'Open', $status);
                   }
                   $add=array('Go Back'=>'?page=homepage&type=subnav&subpage=enquiry');
                   $body.=$view->getcmsbox('', 'Enquiries Received', $d, '', $add);
               }else{
               $m='';
               if(isset($_REQUEST['eid'])){
                   if(isset($_REQUEST['del'])){
                       if($db->delete('enquiries', "id='".$_REQUEST['eid']."'")){
                           $m=$view->highlightsuccess("Enquiry Successfully Deleted!");
                       }
                   }
               }
              
                $re=$db->querydb("SELECT * FROM enquiries ORDER BY added DESC LIMIT 0, 100");
                $status = 'read';
                $id=1;
                if($re->num_rows){
                    $tro[]=array('S.No','Name', 'Phone', 'Email', 'Date of Request', 'Status','Action');
                    while($v=$re->fetch_object()){
                        $status = 'read';
                        if($v->readstatus == '1'){
                            $status = 'unread';
                        }
                     $vie='<a href="?page=homepage&subpage=enquiry&eid='.$v->id.'&view">View</a>';   
                     $del='<a href="?page=homepage&type=subnav&subpage=enquiry&eid='.$v->id.'&del" onclick="return confirm(\'Are you sure, you want to delete?\')">Delete</a>';
                     $dor=date('Y-m-d', $v->added);
                     $tro[]=array($id++, $v->name, '<div style="width: 10px;">'.$v->phone.'</div>', $v->email, $dor, $status,$vie."&nbsp;&nbsp;".$del);
                    }
                $body.=$view->getcmsbox('', 'Enquiries Received', $m.$view->createdatatable($tro), 'Click on the above enquiries to track your follow-up.');
                
                }
               }
            ?>