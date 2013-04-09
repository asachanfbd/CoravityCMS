            <?php
                $re = $enquiry->getall();
                $status = 'read';
                if($re){
                    $rows = array();
                    foreach($re as $v){
                        $status = 'read';
                        if($v->readstatus == '1'){
                            $status = 'unread';
                        }
                        $rows[] = $view->getcmsrow($id, $v->id, $v->name, 'Submitted '.getRelativeTime($v->added), 'Edit', $status);
                    }
                    echo $view->getcmsbox('','Enquiries Received', $rows, 'Click on the above enquiries to track your follow-up.');
                }else{
                    echo 'No Page Exists into Database';
                }
            ?>
