<?php
setcookie("man",uniqid(),time()+3600*24*365);
require_once("manage/lib/library.php");

    $data=array();
    $page='';
    if(!$requireinstallations){
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
        $data['mainnavigation']=$view->getfrontnav('root', $page);
        echo $view->htmlframe($data,$page);
    }else{
        $data = array('pagetitle' => 'Website Management Configuration Wizard', 'mainnavigation' => '', 'mainbody' => '', 'footer' => '');
        if(isset($_REQUEST['conditionaccepted'])){
            $data['mainbody'] .= '
            <form name="dbinfoform" id="dbinfoform" method="post">
                <table>
                   <tr>
                      <th colspan="2">
                         Enter database connection info
                      </th>
                   </tr>
                   <tr>
                      <td>
                         Host
                      </td>
                      <td>
                         <input type="text" name="hostname" id="hostname">
                      </td>
                   </tr>
                   <tr>
                      <td>
                         Username
                      </td>
                      <td>
                         <input type="text" name="username" id="username">
                      </td>
                   </tr>
                   <tr>
                      <td>
                         Password
                      </td>
                      <td>
                         <input type="password" name="pass" id="pass">
                      </td>
                   </tr>
                   <tr>
                      <td>
                         Database Name
                      </td>
                      <td>
                         <input type="text" name="dbname" id="dbname">
                      </td>
                   </tr>
                   <tr>
                      <td>
                         
                      </td>
                      <td>
                         <input type="submit" name="dbsave" id="dbsave" value="Next">
                      </td>
                   </tr>
                </table>
                
            </form>';
        }elseif(isset($_REQUEST['dbsave'])){
            $data['mainbody'] .= '<form name="userregform" id="userregform" method="post"><table>
                                                                                             <tr>
                                                                                                <td colspan="2">
                                                                                                   Create your account
                                                                                                </td>
                                                                                             </tr>
                                                                                             <tr>
                                                                                                <td>
                                                                                                   Full Name
                                                                                                </td>
                                                                                                <td>
                                                                                                   <input type="text" name="fullname" id="fullname">
                                                                                                </td>
                                                                                             </tr>
                                                                                             <tr>
                                                                                                <td>
                                                                                                   Email ID
                                                                                                </td>
                                                                                                <td>
                                                                                                   <input type="text" name="email" id="email">
                                                                                                </td>
                                                                                             </tr>
                                                                                             <tr>
                                                                                                <td>
                                                                                                   Mobile Number
                                                                                                </td>
                                                                                                <td>
                                                                                                   <input type="text" name="phone" id="phone">
                                                                                                </td>
                                                                                             </tr>
                                                                                             <tr>
                                                                                                <td>
                                                                                                   New Password
                                                                                                </td>
                                                                                                <td>
                                                                                                   <input type="password" name="newpass" id="newpass">
                                                                                                </td>
                                                                                             </tr>
                                                                                             <tr>
                                                                                                <td>
                                                                                                   Confirm Password
                                                                                                </td>
                                                                                                <td>
                                                                                                   <input type="password" name="confirmpass" id="confirmpass">
                                                                                                </td>
                                                                                             </tr>
                                                                                             <tr>
                                                                                                <td>
                                                                                                   &nbsp;
                                                                                                </td>
                                                                                                <td>
                                                                                                   <input type="submit" name="userregsubmit" id="userregsubmit" value="Next">
                                                                                                </td>
                                                                                             </tr>
                                                                                          </table>
                                                                                          </form>';
        }elseif(isset($_REQUEST['userregsubmit'])){
            $data['mainbody'] .= 'Now Creating Tables & Creating user profile';
        }else{
            $data['mainbody'] .= '<form name="termsncondform" id="termsncondform" method="POST">
                                    <table>
                                     <tr>
                                        <td>
                                           <h1>To Proceed accept the terms of use below:</h1>
                                        </td>
                                     </tr>
                                     <tr>
                                        <td>
                                           <textarea readonly="readonly" name="conditions" id="conditions" rows="3" cols="80"   style="width:400px; height: 100px;">Terms & Conditions of use.</textarea>
                                        </td>
                                     </tr>
                                     <tr>
                                        <td>
                                           <input type="checkbox" name="conditionaccepted" id="conditionaccepted" value="conditionaccepted">&nbsp;I Accept the above Terms & Conditions.
                                        </td>
                                     </tr>
                                     <tr>
                                        <td>
                                           <input type="submit" name="conditionaccepted_but" id="conditionaccepted_but" value="Next" class="button">
                                        </td>
                                     </tr>
                                  </table></form>
                                  ';
        }
        echo $view->htmlframe($data, 'install');
    }
    
?>